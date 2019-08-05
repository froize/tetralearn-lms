<?php

namespace app\modules\admin\controllers;

use app\models\Chapter;
use app\models\Course;
use app\models\CourseGroup;
use app\models\UserCourse;
use app\models\User;
use app\models\Gang;
use Yii;
use app\models\Lecture;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\HttpException;
use yii\web\UploadedFile;
use app\models\UploadFile;

/**
 * LectureController implements the CRUD actions for Lecture model.
 */
class LectureController extends AppAdminController
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
     * Lists all Lecture models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->view->params['header'] = 'Лекции';
        $this->view->params['description'] = 'Просмотр всех созданных лекций';
        $dataProvider = new ActiveDataProvider([
            'query' => Lecture::find()
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
     * Displays a single Lecture model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->view->params['header'] = 'Лекции';
        $this->view->params['description'] = 'Просмотр лекции';
        $model = $this->findModel($id);
        $course = Course::find()
            ->asArray()
            ->joinWith('chapters')
            ->joinWith('chapters.lectures')
            ->where([
                'lecture.id' => $model->id
            ])->one();

        if($course['tutor_id'] == Yii::$app->user->getId() && !Yii::$app->user->isGuest)
        return $this->render('view', [
            'model' => $this->findModel($id),

        ]);
        else {
            throw new HttpException(403 ,'Доступ запрещен');
        }
    }

    /**
     * Creates a new Lecture model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->view->params['header'] = 'Лекции';
        $this->view->params['description'] = 'Создание новой лекции';
        $model = new Lecture();
        $chapters = Chapter::find()
            ->joinWith('course')
            ->where([
                'course.tutor_id' => Yii::$app->user->getId()
            ])->all();
        $chapters = ArrayHelper::map($chapters, 'id', 'name');

        $uploaded_file = new UploadFile();
            if ($model->load(Yii::$app->request->post())) {
                $uploaded_file->file = UploadedFile::getInstance($uploaded_file, 'file');


                $uploaded_file->upload();
                if($model->saveLecture($uploaded_file->file->baseName.'.'.$uploaded_file->file->extension)) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }

        }
        if(Yii::$app->user->getId() && !Yii::$app->user->isGuest)
        return $this->render('create', [
            'model' => $model,
            'chapters' => $chapters,
            'uploaded_file' => $uploaded_file,
        ]);
        else {
            throw new HttpException(403 ,'Доступ запрещен');
        }
    }
    /**
     * Updates an existing Lecture model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $this->view->params['header'] = 'Лекции';
        $this->view->params['description'] = 'Изменение лекции';
        $model = $this->findModel($id);
        $chapter = Chapter::find()->asArray()->where(['id' => $model->chapter_id])->one();
        $course = Course::find()
            ->asArray()
            ->joinWith('chapters')
            ->joinWith('chapters.lectures')
            ->where([
                'lecture.id' => $model->id
            ])->one();
        $chapters = Chapter::find()
            ->joinWith('course')
            ->where([
                'course.tutor_id' => Yii::$app->user->getId()
            ])->all();
        $chapters = ArrayHelper::map($chapters, 'id', 'name');

        $uploaded_file = new UploadFile();
        if ($model->load(Yii::$app->request->post())) {
            $uploaded_file->file = UploadedFile::getInstance($uploaded_file, 'file');

            $uploaded_file->upload();
            if($model->saveLecture($uploaded_file->file->baseName.'.'.$uploaded_file->file->extension)) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

        }
        if($course['tutor_id'] == Yii::$app->user->getId() && !Yii::$app->user->isGuest)
        return $this->render('update', [
            'model' => $model,
            'chapters' => $chapters,
            'uploaded_file' => $uploaded_file,
        ]);
        else {
            throw new HttpException(403 ,'Доступ запрещен');
        }
    }

    /**
     * Deletes an existing Lecture model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $chapter = Chapter::find()->asArray()->where(['id' => $model->chapter_id])->one();
        $course = Course::find()->asArray()->where(['id' => $chapter['course_id']])->one();
        if($course['tutor_id'] == Yii::$app->user->getId() && !Yii::$app->user->isGuest) {
            $this->findModel($id)->delete();
        }
        else {
            throw new HttpException(403 ,'Доступ запрещен');
        }

        return $this->redirect(['index']);
    }



    /**
     * Finds the Lecture model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Lecture the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Lecture::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
