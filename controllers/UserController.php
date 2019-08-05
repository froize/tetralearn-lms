<?php

namespace app\controllers;

use app\models\UploadFile;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Yii;
use app\models\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->view->params['header'] = 'Пользователи';
        $this->view->params['description'] = 'Просмотр всех пользователей';
        $dataProvider = new ActiveDataProvider([
            'query' => User::find()
                ->where([
                    'id' => Yii::$app->user->id
                ])
            ,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->view->params['header'] = 'Пользователи';
        $this->view->params['description'] = 'Просмотр данных пользователя';
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionRegister()
    {
        $this->view->params['header'] = 'Пользователи';
        $this->view->params['description'] = 'Регистрация нового пользователя';

        $model = new User();

        $uploaded_file = new UploadFile();
        if(Yii::$app->user->isGuest) {
            if ($model->load(Yii::$app->request->post())) {
                $uploaded_file->file = UploadedFile::getInstance($uploaded_file, 'file');
                $uploaded_file->upload();
                if($model->saveUser($uploaded_file->file->baseName.'.'.$uploaded_file->file->extension)) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
            return $this->render('register', [
                'model' => $model,
                'uploaded_file' => $uploaded_file,
            ]);
        }
        else {
            throw new AccessDeniedException('Вы уже зарегистрированы.');
        }


    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $this->view->params['header'] = 'Пользователи';
        $this->view->params['description'] = 'Изменение данных пользователя';

        $model = $this->findModel($id);

        $uploaded_file = new UploadFile();
        if($id = Yii::$app->user->id) {
            if ($model->load(Yii::$app->request->post())) {
                $uploaded_file->file = UploadedFile::getInstance($uploaded_file, 'file');
                $uploaded_file->upload();
                if($model->saveUser($uploaded_file->file->baseName.'.'.$uploaded_file->file->extension)) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }

            return $this->render('update', [
                'model' => $model,
                'uploaded_file' => $uploaded_file,
            ]);
        }
        else {
            throw new AccessDeniedException('Вам не разрешено изменять эту страницу');
        }

    }

    /**
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
