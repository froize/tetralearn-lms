<?php

namespace app\controllers;

use app\models\UploadFile;
use app\models\UserTask;
use Yii;
use app\models\Task;
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
    public function beforeAction($action)
    {
        if ($action->id == 'upload-file') {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }

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
        $searchModel = new TaskSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
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

        $assessment = UserTask::find()
            ->asArray()
            ->where([
                'student_id' => Yii::$app->user->id,
                'task_id' => $model->id,
            ])
            ->one();

        $user_task = UserTask::find()
            ->where([
                'task_id' => $id,
                'student_id' => Yii::$app->user->id
            ])
            ->asArray()
            ->one();

        $usertask = new UserTask();

        if ($user_task != array()) {
            $usertask = UserTask::findOne($user_task['id']);
        }
        $uploaded_file = new UploadFile();
        if (Yii::$app->request->post() != array()) {


            $uploaded_file->file = UploadedFile::getInstance($uploaded_file, 'file');
            $uploaded_file->upload();
            $usertask->saveUserTask($id, $uploaded_file->file->baseName . '.' . $uploaded_file->file->extension);
        }

        return $this->render('view', [
            'model' => $model,
            'course' => $course,
            'assessment' => $assessment,
            'uploaded_file' => $uploaded_file,
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $chapter = Chapter::find()->asArray()->where(['id' => Yii::$app->request->queryParams['chapter_id']])->one();
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
            //return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
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
        $this->view->params['header'] = 'Задания';
        $this->view->params['description'] = 'Удалить задание';
        $chapter = Chapter::find()->asArray()->where(['id' => $this->chapter_id])->one();
        $course = Course::find()->where(['id' => $chapter['id']])->one();
        $group_ids = CourseGroup::find()->asArray()->where(['course_id' => $course->id])->all();
        $student_ids = array();
        $k = 0;
        foreach ($group_ids as $group_id) {
            $student_ids[$k] = User::find()->asArray()->where(['group_id' => $group_id['id']])->all();
            $k++;
        }
        foreach ($student_ids as $student_id) {
            foreach ($student_id as $value) {
                Dialog::deleteAll(['tutor_id' => $course->tutor_id, 'student_id' => $value['id'], 'task_id' => $this->id]);
            }
            $k++;
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionUploadFile()
    {
        if (Yii::$app->request->isPost) {
            $this->enableCsrfValidation = false;
            $taskId = Yii::$app->request->post('task_id');
            $task = Task::findOne($taskId);

            if ($task) {

                $file = UploadedFile::getInstanceByName('file');
                $directory = Yii::getAlias('@webroot') . '/uploads/';

                if ($file) {
                    $task->file = strtotime('now') . '_' . Yii::$app->getSecurity()->generateRandomString(10) . '.' . $file->extension;

                    if ($file->saveAs($directory . $task->file)) {
                        $task->save(false);
                    }
                }
            }
        }
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
