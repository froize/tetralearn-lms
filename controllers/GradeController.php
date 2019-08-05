<?php

namespace app\controllers;

use app\models\Chapter;
use app\models\Course;
use app\models\CourseGroup;
use app\models\Task;
use app\models\User;
use Yii;
use app\models\UserTask;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GradesController implements the CRUD actions for UserTask model.
 */
class GradeController extends SiteController
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
        $courses = array();
        $user = User::find()->asArray()->where(['id'=> Yii::$app->user->getId()])->one();
        $courses_participant = CourseGroup::find()->asArray()->where(['group_id'=> $user['group_id']])->all();

        $i = 0;

        foreach ($courses_participant as $course) {
            $courses[] = Course::find()->joinWith('chapters')->asArray()->where(['course.id' => $courses_participant[$i]['course_id']])->one();
            $i++;
        }

        $i = 0;$j = 0;
        foreach ($courses as $course) {
            foreach ($courses[$i]['chapters'] as $chapter) {
                $courses[$i]['chapters'][$j]['tasks'][] = Task::find()->joinWith('userTasks')->asArray()->where(['chapter_id' => $courses[$i]['chapters'][$j]['id']])->all();
                $j++;
            }
            $i++;
        }
        $dataProvider = new ActiveDataProvider([
            'query' => UserTask::find()
                ->joinWith('student', true)
                ->joinWith('task', true)
                ->joinWith('task.chapter',true)
                ->joinWith('task.chapter.course',true)
                ->where([
                    'user.id' => Yii::$app->user->id
                ])
                ->limit(20)
            ,
        ]);
        return $this->render('index', [
            'courses' => $courses,
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
        $this->view->params['description'] = 'Оценки';
        $model = new UserTask();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('create', [
            'model' => $model,

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
        $this->view->params['description'] = 'Оценки';
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
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
        $this->view->params['header'] = 'Оценки';
        $this->view->params['description'] = 'Оценки';
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
