<?php

namespace app\modules\admin\controllers;

use app\models\Chapter;
use app\models\Course;
use app\models\CourseGroup;
use app\models\Task;
use app\models\User;
use Yii;
use app\models\UserTask;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GradesController implements the CRUD actions for UserTask model.
 */
class GradeController extends Controller
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
     * Lists all UserTask models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->view->params['header'] = 'Оценки';
        $this->view->params['description'] = 'Просмотр всех сданных заданий, полученных оценок';

        $dataProvider = new ActiveDataProvider([
            'query' => UserTask::find()
                ->joinWith('student', true)
                ->joinWith('task', true)
                ->joinWith('task.chapter',true)
                ->joinWith('task.chapter.course',true)
                ->where([
                    'course.tutor_id' => Yii::$app->user->id
                ])
                ->limit(20)
            ,
        ]);
        return $this->render('index', [
//            'course_groups' => $course_groups,
//            'courses' => $courses,
//            'students' => $students,
//            'grades' => $grades,
//            'tasks' => $tasks,
            'dataProvider' => $dataProvider,

        ]);
    }

    /**
     * Displays a single UserTask model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->view->params['header'] = 'Оценки';
        $this->view->params['description'] = 'Просмотр сданного задания';
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new UserTask model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->view->params['header'] = 'Оценки';
        $this->view->params['description'] = 'Создание оценки';
        $model = new UserTask();
        $tasks_list = Task::find()
            ->joinWith('chapter', true)
            ->joinWith('chapter.course', true)
            ->where([
                'course.tutor_id' => Yii::$app->user->id
            ])->all();
        $tasks_list = ArrayHelper::map($tasks_list, 'id', 'name');
        $users = User::find()
            ->where(['!=', 'id', Yii::$app->user->id])->all();
        for($i=0;$i<count($users);$i++) {
            $users[$i]['name'] = $users[$i]['name']. ' ' . $users[$i]['surname'];
        }
        $users = ArrayHelper::map($users, 'id', 'name');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('create', [
            'model' => $model,
            'tasks_list' => $tasks_list,
            'users' => $users,

        ]);
    }

    /**
     * Updates an existing UserTask model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $this->view->params['header'] = 'Оценки';
        $this->view->params['description'] = 'Выставление оценки';
        $model = $this->findModel($id);
        $tasks_list = Task::find()
            ->joinWith('chapter', true)
            ->joinWith('chapter.course', true)
            ->where([
                'course.tutor_id' => Yii::$app->user->id
            ])->all();
        $tasks_list = ArrayHelper::map($tasks_list, 'id', 'name');
        $users = User::find()
            ->where(['!=', 'id', Yii::$app->user->id])->all();
        for($i=0;$i<count($users);$i++) {
            $users[$i]['name'] = $users[$i]['name']. ' ' . $users[$i]['surname'];
        }
        $users = ArrayHelper::map($users, 'id', 'name');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'tasks_list' => $tasks_list,
            'users' => $users,
        ]);
    }

    /**
     * Deletes an existing UserTask model.
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
     * Finds the UserTask model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserTask the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserTask::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
