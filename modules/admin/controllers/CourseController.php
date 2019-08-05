<?php

namespace app\modules\admin\controllers;

use app\models\Chapter;
use app\models\CourseGroup;
use app\models\Gang;
use app\models\Lecture;
use app\models\Task;
use app\models\UploadFile;
use app\models\User;
use app\models\UserCourse;
use Yii;
use app\models\Course;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\HttpException;
use yii\web\UploadedFile;

/**
 * CourseController implements the CRUD actions for Course model.
 */
class CourseController extends AppAdminController
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
     * Lists all Course models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->view->params['header'] = 'Курсы 2019';
        $this->view->params['description'] = 'Просмотр всех ваших курсов';

        $dataProvider = new ActiveDataProvider([
            'query' => Course::find()
                ->where([
                    'tutor_id' => Yii::$app->user->id
                ])
                ->limit(20)
            ,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionView($id)
    {
        $this->view->params['header'] = 'Курсы';
        $this->view->params['description'] = 'Просмотр курса';
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    /**
     * Displays a single Course model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionLearn($id)
    {
        $model = $this->findModel($id);
        $this->view->params['header'] = $model->name;
        $this->view->params['description'] = 'Просмотр курса';

        $course = Course::find()->joinWith('chapters')->joinWith('reports')->asArray()->where(['course.id' => $model->id])->one();

        $i = 0;
            foreach ($course['chapters'] as $chapter) {
                $course['chapters'][$i]['lectures'][] = Lecture::find()->asArray()->where(['chapter_id' => $course['chapters'][$i]['id']])->all();
                $course['chapters'][$i]['tasks'][] = Task::find()->asArray()->where(['chapter_id' => $course['chapters'][$i]['id']])->all();
                $i++;
            }

        if(($model->tutor_id == Yii::$app->user->getId()) && !Yii::$app->user->isGuest)
        return $this->render('learn', [
            'model' => $this->findModel($id),
            'course' => $course,

        ]);
        else {
            throw new HttpException(403 ,'Доступ запрещен');
        }
    }

    public function actionCreate()
    {
        $this->view->params['header'] = 'Курсы';
        $this->view->params['description'] = 'Создание курса';
        $model = new Course();
        $user_course = new UserCourse();
        $groups = Gang::find()->asArray()->all();
        $groups = ArrayHelper::map($groups, 'id', 'name');
        $users = User::find()->asArray()->where(['!=', 'id', Yii::$app->user->id])->all();
        $participants_users = array();
        $i = 0;
        foreach ($users as $user) {
            $participants_users[$i]['id'] = $user['id'];
            $participants_users[$i]['fullname'] = $user['name']. ' '. $user['surname'];
            $i++;
        }
        $participants_users = ArrayHelper::map($participants_users, 'id', 'fullname');
        $uploaded_file = new UploadFile();

        if ($model->load(Yii::$app->request->post())) {
            if(UploadedFile::getInstance($uploaded_file, 'file')) {
                $uploaded_file->file = UploadedFile::getInstance($uploaded_file, 'file');
                $uploaded_file->upload();

                if($model->saveCourse($uploaded_file->file->baseName.'.'.$uploaded_file->file->extension)) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
            else {
                if($model->saveCourse('.')) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }

        }
        if(!Yii::$app->user->isGuest) {
            return $this->render('create', [
                'model' => $model,
                'participants_users' => $participants_users,
                'user_course' => $user_course,
                'groups' => $groups,
                'uploaded_file' => $uploaded_file,
            ]);
        }
        else {
            throw new HttpException(403 ,'Доступ запрещен');
        }
    }
    /**
     * Updates an existing Course model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $this->view->params['header'] = 'Курсы';
        $this->view->params['description'] = 'Изменение курса';

        $model = $this->findModel($id);

        $groups = Gang::find()->asArray()->all();
        $groups = ArrayHelper::map($groups, 'id', 'name');
        $users = User::find()->asArray()->where(['!=', 'id', Yii::$app->user->identity->getId()])->all();
        $participants_users = array();
        $i = 0;
        foreach ($users as $user) {
            $participants_users[$i]['id'] = $user['id'];
            $participants_users[$i]['fullname'] = $user['name']. ' '. $user['surname']. ' (ID:'. $user['id']. ')';
            $i++;
        }
        $participants_users = ArrayHelper::map($participants_users, 'id', 'fullname');
        $uploaded_file = new UploadFile();
        if ($model->load(Yii::$app->request->post())) {
            if(UploadedFile::getInstance($uploaded_file, 'file')) {
                $uploaded_file->file = UploadedFile::getInstance($uploaded_file, 'file');
                $uploaded_file->upload();

                if($model->saveCourse($uploaded_file->file->baseName.'.'.$uploaded_file->file->extension)) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
            else {
                if($model->saveCourse('.')) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }

        }
        if($model->tutor_id == Yii::$app->user->getId() && !Yii::$app->user->isGuest) {
            return $this->render('update', [
                'model' => $this->findModel($id),
                'participants_users' => $participants_users,
                'groups' => $groups,
                'uploaded_file' => $uploaded_file,
            ]);
        }
        else {
            throw new HttpException(403 ,'Доступ запрещен');
        }

    }

    /**
     * Deletes an existing Course model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if($model->tutor_id == Yii::$app->user->getId() && !Yii::$app->user->isGuest) {
            $this->findModel($id)->delete();
            return $this->redirect(['index']);
        }
        else {
            throw new HttpException(403 ,'Доступ запрещен');
        }


    }

    /**
     * Finds the Course model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Course the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Course::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Creates a new Course model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */



}
