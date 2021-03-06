<?php

namespace app\modules\admin\controllers;

use app\models\User;
use Yii;
use app\models\Invitation;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Course;

/**
 * InvitationController implements the CRUD actions for Invitation model.
 */
class InvitationController extends Controller
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
     * Lists all Invitation models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->view->params['header'] = 'Заявки';
        $this->view->params['description'] = 'Просмотр всех поданных заявок';
        $dataProvider = new ActiveDataProvider([
            'query' => Invitation::find()
                ->joinWith('course', true)
                ->joinWith('user', true)
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
     * Displays a single Invitation model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->view->params['header'] = 'Заявки';
        $this->view->params['description'] = 'Просмотр поданной заявки';
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Invitation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->view->params['header'] = 'Заявки';
        $this->view->params['description'] = 'Создание заявки';
        $model = new Invitation();
        $courses = Course::find()
            ->where([
                'course.tutor_id' => Yii::$app->user->id
            ])->all();
        $courses = ArrayHelper::map($courses, 'id', 'name');
        $users = User::find()
            ->where(['!=', 'id', Yii::$app->user->id])->all();
        for($i=0;$i<count($users);$i++) {
            $users[$i]['name'] = $users[$i]['name']. ' ' . $users[$i]['surname'];
        }
        $users = ArrayHelper::map($users, 'id', 'name');
        if ($model->load(Yii::$app->request->post()) && $model->saveInvitationAndAccept()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'courses' => $courses,
            'users' => $users,
        ]);
    }

    /**
     * Updates an existing Invitation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $this->view->params['header'] = 'Заявки';
        $this->view->params['description'] = 'Просмотр поданной заявки';
        $model = $this->findModel($id);
        $courses = Course::find()
            ->where([
                'course.tutor_id' => Yii::$app->user->id
            ])->all();
        $courses = ArrayHelper::map($courses, 'id', 'name');
        $users = User::find()
            ->where(['!=', 'id', Yii::$app->user->id])->all();
        for($i=0;$i<count($users);$i++) {
            $users[$i]['name'] = $users[$i]['name']. ' ' . $users[$i]['surname'];
        }
        $users = ArrayHelper::map($users, 'id', 'name');
        if ($model->load(Yii::$app->request->post()) && $model->saveInvitationAndAccept()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'courses' => $courses,
            'users' => $users,
        ]);
    }

    /**
     * Deletes an existing Invitation model.
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
     * Finds the Invitation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Invitation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Invitation::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
