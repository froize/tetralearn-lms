<?php

namespace app\modules\admin\controllers;

use app\models\UploadFile;
use Yii;
use app\models\Task;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Chapter;
use app\models\CourseGroup;
use app\models\Course;
use app\models\Dialog;
use app\models\User;
use yii\web\UploadedFile;

/**
 * TaskController implements the CRUD actions for Task model.
 */
class TaskController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Task models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->view->params['header'] = 'Задания';
        $this->view->params['description'] = 'Просмотр всех доступных заданий';
        $dataProvider = new ActiveDataProvider([
            'query' => Task::find()
                ->joinWith('chapter')
                ->joinWith('chapter.course')
                ->where([
                    'course.tutor_id' => Yii::$app->user->id
                ])
                ->limit(20)
            ,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);

    }

    /**
     * Displays a single Task model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->view->params['header'] = 'Задания';
        $this->view->params['description'] = 'Просмотр задания';
        $model = $this->findModel($id);
        $course = Course::find()
            ->joinWith('chapters')
            ->joinWith('chapters.tasks')
            ->where(['task.id' => $model->id])
            ->one();
        return $this->render('view', [
            'model' => $model,
            'course' => $course,
        ]);
    }

    /**
     * Creates a new Task model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->view->params['header'] = 'Задания';
        $this->view->params['description'] = 'Создание задания';
        $model = new Task();
        $chapters = Chapter::find()
            ->joinWith('course')
            ->where([
                'course.tutor_id' => Yii::$app->user->getId()
            ])->all();
        $chapters = ArrayHelper::map($chapters, 'id', 'name');

        $uploaded_file = new UploadFile();
        $file_url = '.';
        if ($model->load(Yii::$app->request->post())) {
            if (UploadedFile::getInstance($uploaded_file, 'file')) {
                $uploaded_file->file = UploadedFile::getInstance($uploaded_file, 'file');
                $uploaded_file->upload();
                $file_url = $uploaded_file->file->baseName . '.' . $uploaded_file->file->extension;
            }

            if ($model->saveTask($file_url)) {
                $chapter = Chapter::find()
                    ->joinWith('tasks')
                    ->where([
                        'task.id' => $model->id
                    ])
                    ->asArray()
                    ->one();
                $course = Course::find()->asArray()->where(['id' => $chapter['course_id']])->one();
                $group_ids = CourseGroup::find()->asArray()->where(['course_id' => $course['id']])->all();
                $student_ids = array();
                $dialog = new Dialog();
                $k = 0;
                foreach ($group_ids as $group_id) {
                    $student_ids[$k] = User::find()->asArray()->where(['group_id' => $group_id['group_id']])->all();
                    $k++;
                }
                $student_ids = array_unique($student_ids);

                foreach ($student_ids as $student_id) {
                    foreach ($student_id as $value) {
                        $dialog->saveDialog($course['tutor_id'], $value['id'], $model->id);
                    }
                    $k++;
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        if (!Yii::$app->user->isGuest) {
            return $this->render('create', [
                'model' => $model,
                'chapters' => $chapters,
                'uploaded_file' => $uploaded_file,
            ]);
        }

    }

    /**
     * Updates an existing Task model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $this->view->params['header'] = 'Задания';
        $this->view->params['description'] = 'Изменить задание';
        $model = $this->findModel($id);
        $chapters = Chapter::find()
            ->joinWith('course')
            ->where([
                'course.tutor_id' => Yii::$app->user->getId()
            ])->all();
        $chapters = ArrayHelper::map($chapters, 'id', 'name');

        $uploaded_file = new UploadFile();
        $file_url = '.';
        if ($model->load(Yii::$app->request->post())) {
            if (UploadedFile::getInstance($uploaded_file, 'file')) {
                $uploaded_file->file = UploadedFile::getInstance($uploaded_file, 'file');
                $uploaded_file->upload();
                $file_url = $uploaded_file->file->baseName . '.' . $uploaded_file->file->extension;
            }

            if ($model->saveTask($file_url)) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        if (!Yii::$app->user->isGuest) {
            return $this->render('update', [
                'model' => $model,
                'chapters' => $chapters,
                'uploaded_file' => $uploaded_file,
            ]);
        }
    }

    /**
     * Deletes an existing Task model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        Dialog::deleteAll(['tutor_id' => Yii::$app->user->id, 'task_id' => $this->id]);
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Task model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Task the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Task::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
