<?php

namespace app\modules\admin\controllers;

use app\models\User;
use Yii;
use app\models\Gang;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GroupController implements the CRUD actions for Gang model.
 */
class GroupController extends Controller
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
     * Lists all Gang models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->view->params['header'] = 'Группы';
        $this->view->params['description'] = 'Список групп';
        $dataProvider = new ActiveDataProvider([
            'query' => Gang::find()
                ->limit(20)
            ,
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Gang model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->view->params['header'] = 'Группы';
        $this->view->params['description'] = 'Просмотр группы';
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Gang model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->view->params['header'] = 'Группы';
        $this->view->params['description'] = 'Создание группы';
        $model = new Gang();


        $users = User::find()
            ->where(['!=', 'id', Yii::$app->user->id])
            ->all();
        $participants_users = array();
        $i = 0;
        foreach ($users as $user) {
            $participants_users[$i]['id'] = $user['id'];
            $participants_users[$i]['fullname'] = $user['name']. ' '. $user['surname'];
            $i++;
        }
        $participants_users = ArrayHelper::map($participants_users, 'id', 'fullname');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'participants_users' => $participants_users,
        ]);
    }

    /**
     * Updates an existing Gang model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $this->view->params['header'] = 'Группы';
        $this->view->params['description'] = 'Изменение группы';
        $users = User::find()
            ->where(['!=', 'id', Yii::$app->user->id])
            ->all();
        $participants_users = array();
        $i = 0;
        foreach ($users as $user) {
            $participants_users[$i]['id'] = $user['id'];
            $participants_users[$i]['fullname'] = $user['name']. ' '. $user['surname'];
            $i++;
        }
        $participants_users = ArrayHelper::map($participants_users, 'id', 'fullname');


        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->saveGroup()) {

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'participants_users' => $participants_users,
        ]);
    }

    /**
     * Deletes an existing Gang model.
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
     * Finds the Gang model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Gang the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Gang::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
