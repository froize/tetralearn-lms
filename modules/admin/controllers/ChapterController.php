<?php

namespace app\modules\admin\controllers;

use app\models\Report;
use app\models\UserReport;
use Yii;
use app\models\Chapter;
use app\models\CourseGroup;
use app\models\UserCourse;
use app\models\User;
use app\models\Gang;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Course;
use yii\web\HttpException;

/**
 * ChapterController implements the CRUD actions for Chapter model.
 */
class ChapterController extends AppAdminController
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
     * Lists all Chapter models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->view->params['header'] = 'Главы';
        $this->view->params['description'] = 'Просмотр всех созданных глав';
        $dataProvider = new ActiveDataProvider([
            'query' => Chapter::find()
                ->joinWith('course')
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

    public function actionView($id)
    {
        $model = $this->findModel($id);
        $this->view->params['header'] = $model->name;
        $this->view->params['description'] = 'Просмотр главы';
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Displays a single Chapter model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionLearn($id)
    {
        $model = $this->findModel($id);
        $this->view->params['header'] = $model->name;
        $this->view->params['description'] = 'Просмотр главы';
        $course = Course::find()->asArray()->where(['id' => $model->course_id])->one();
        $chapter = Chapter::find()->joinWith('lectures')->joinWith('tasks')->asArray()->where(['chapter.id' => $model->id])->one();

        $reports = Report::find()->asArray()->where(['course_id' => $course['id']])->all();

        if (($course['tutor_id'] == Yii::$app->user->getId()) && !Yii::$app->user->isGuest)
            return $this->render('learn', [
                'model' => $this->findModel($id),
                'chapter' => $chapter,
                'reports' => $reports,
            ]);
        else {
            throw new HttpException(403, 'Доступ запрещен');
        }
    }



    /**
     * Creates a new Chapter model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->view->params['header'] = 'Главы';
        $this->view->params['description'] = 'Создание новой главы';
        $model = new Chapter();
        $courses = Course::find()->asArray()->where(['tutor_id' => Yii::$app->user->getId()])->all();
        $courses = ArrayHelper::map($courses, 'id', 'name');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        if (!Yii::$app->user->isGuest)
            return $this->render('create', [
                'model' => $model,
                'courses' => $courses,
            ]);
        else {
            throw new HttpException(403, 'Доступ запрещен');
        }
    }

    /**
     * Updates an existing Chapter model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $this->view->params['header'] = 'Главы';
        $this->view->params['description'] = 'Изменение главы';
        $model = $this->findModel($id);
        $course = Course::find()->asArray()->where(['id' => $model->course_id])->one();
        $courses = Course::find()->asArray()->where(['tutor_id' => Yii::$app->user->getId()])->all();
        $courses = ArrayHelper::map($courses, 'id', 'name');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        if ($course['tutor_id'] == Yii::$app->user->getId() && !Yii::$app->user->isGuest)
            return $this->render('update', [
                'model' => $model,
                'courses' => $courses,
            ]);
        else {
            throw new HttpException(403, 'Доступ запрещен');
        }
    }

    /**
     * Deletes an existing Chapter model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->view->params['header'] = 'Главы';
        $this->view->params['description'] = 'Удаление главы';
        $model = $this->findModel($id);
        $course = Course::find()->asArray()->where(['id' => $model->course_id])->one();
        if ($course['tutor_id'] == Yii::$app->user->getId() && !Yii::$app->user->isGuest) {
            $this->findModel($id)->delete();
            return $this->redirect(['index']);
        } else {
            throw new HttpException(403, 'Доступ запрещен');
        }

    }

    /**
     * Finds the Chapter model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Chapter the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Chapter::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
