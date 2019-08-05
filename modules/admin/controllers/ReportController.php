<?php

namespace app\modules\admin\controllers;

use app\models\Course;
use app\models\UserReport;
use Yii;
use app\models\Report;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * ReportController implements the CRUD actions for Report model.
 */
class ReportController extends Controller
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
     * Lists all Report models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->view->params['header'] = 'Доклады';
        $this->view->params['description'] = 'Просмотр всех докладов';
        $own_reports = Report::find()
            ->joinWith('course', true)
            ->where([
                'course.tutor_id' => Yii::$app->user->id
            ])
            ->limit(20);

        $dataProviderOwnReports = new ActiveDataProvider([
            'query' => $own_reports,
        ]);
        $dataProvider = new ActiveDataProvider([
            'query' => UserReport::find()
                ->joinWith('report',true)
                ->joinWith('user',true)
                ->joinWith('report.course',true)
                ->where([
                    'Course.tutor_id' => Yii::$app->user->id
                ])
,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'dataProviderOwnReports' => $dataProviderOwnReports,
        ]);
    }

    /**
     * Displays a single Report model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->view->params['header'] = 'Доклады';
        $this->view->params['description'] = 'Просмотр доклада';
        $courses = Course::find()->asArray()->where(['tutor_id' => Yii::$app->user->getId()])->all();
        $courses = ArrayHelper::map($courses, 'id', 'name');
        return $this->render('view', [
            'model' => $this->findModel($id),
            'courses' => $courses,

        ]);
    }

    /**
     * Creates a new Report model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->view->params['header'] = 'Доклады';
        $this->view->params['description'] = 'Создать доклад';
        $model = new Report();
        $courses = Course::find()->asArray()->where(['tutor_id' => Yii::$app->user->getId()])->all();
        $courses = ArrayHelper::map($courses, 'id', 'name');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'courses' => $courses,
        ]);
    }

    /**
     * Updates an existing Report model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $this->view->params['header'] = 'Доклады';
        $this->view->params['description'] = 'Изменить доклад';
        $model = $this->findModel($id);
        $courses = Course::find()->asArray()->where(['tutor_id' => Yii::$app->user->getId()])->all();
        $courses = ArrayHelper::map($courses, 'id', 'name');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'courses' => $courses,
        ]);
    }

    /**
     * Deletes an existing Report model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Report model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Report the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Report::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}