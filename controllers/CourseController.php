<?php

namespace app\controllers;

use app\helpers\HelpersFunctions;
use app\models\Chapter;
use app\models\CourseGroup;
use app\models\Gang;
use app\models\Invitation;
use app\models\Lecture;
use app\models\Report;
use app\models\Task;
use app\models\User;
use app\models\UserCourse;
use app\models\UserReport;
use Yii;
use app\models\Course;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\HttpException;

/**
 * CourseController implements the CRUD actions for Course model.
 */
class CourseController extends SiteController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors(){
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
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
        $this->view->params['header'] = 'Курсы';
        $this->view->params['description'] = 'Просмотр всех активных курсов';
        $user = User::find()->asArray()->where(['id'=>Yii::$app->user->getId()])->one();

        $av_courses = array();
        $available_courses = array();
        $user_participant = UserCourse::find()
            ->joinWith('course')
            ->where([
                'user_id' => Yii::$app->user->id
            ])
            ->asArray()
            ->all();

        $user_group = Gang::find()->asArray()->where(['id'=>$user['group_id']])->one();
        $participant_in_group = CourseGroup::find()

            ->joinWith('group')
            ->joinWith('course')
            ->asArray()
            ->where([
                'group_id'=>$user_group['id']
            ])
            ->asArray()
            ->all();
        foreach ($user_participant as $item) {
            $av_courses[] = $item['course']['id'];
        }
        foreach ($participant_in_group as $item) {
            $av_courses[] = $item['course']['id'];
        }
        $av_courses = array_unique($av_courses);

        $i = 0;
        foreach ($av_courses as $available_course) {
            $available_courses[$i] = Course::find()
                ->asArray()
                ->joinWith('tutor')
                ->where([
                    'course.id' => $available_course
                ])->one();
            $i++;
        }




        return $this->render('index', [
            'available_courses' => $available_courses,
            'user' => $user,
        ]);
    }

    /**
     * Displays a single Course model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->view->params['header'] = 'Курсы';
        $this->view->params['description'] = 'Просмотр курса';

        $model = $this->findModel($id);

        $course_participant = array();
        $group_participant = array();

        $course = Course::find()
            ->joinWith('tutor')
            ->joinWith('chapters')
            ->joinWith('chapters.lectures')
            ->joinWith('chapters.tasks')
            ->where([
                'course.id' => $id
            ])
            ->asArray()
            ->one();
        if(Yii::$app->user->isGuest) {

        }
        $course_participant = UserCourse::find()
            ->asArray()
            ->where([
                'user_id' => Yii::$app->user->id,
                'course_id' => $id
            ])
            ->all();
        $group_participant = CourseGroup::find()
            ->joinWith('group')
            ->joinWith('group.users')
            ->asArray()
            ->where([
                'user.id' => Yii::$app->user->id,
                'course_id' => $id
            ])
            ->all();

        if($course_participant != array() || $group_participant != array()) {
            $is_participant = true;
        }
        else {
            $is_participant = false;
        }

        $invitation = Invitation::find()
            ->asArray()
            ->where([
                'course_id' => $id,
                'user_id' => Yii::$app->user->id,
            ])->one();

        return $this->render('view', [
            'model' => $this->findModel($id),
            'course' => $course,
            'is_participant' => $is_participant,
//            'users_in_group' => $users_in_group,
            'invitation' => $invitation,

        ]);

    }
    public function actionLearn($id)
    {
        $this->view->params['header'] = 'Курсы';
        $this->view->params['description'] = 'Изучение курса';
        $model = $this->findModel($id);
        $this->view->params['header'] = $model->name;
        $this->view->params['description'] = 'Просмотр курса';

        $course = Course::find()
            ->joinWith('chapters')
            ->joinWith('reports')
            ->joinWith('reports.userReports')
            ->asArray()
            ->where(['course.id' => $model->id])->one();

        $i = 0;
        foreach ($course['chapters'] as $chapter) {
            $course['chapters'][$i]['lectures'][] = Lecture::find()->asArray()->where(['chapter_id' => $course['chapters'][$i]['id']])->all();
            $course['chapters'][$i]['tasks'][] = Task::find()->asArray()->where(['chapter_id' => $course['chapters'][$i]['id']])->all();
            $i++;
        }

        if( !Yii::$app->user->isGuest)
            return $this->render('learn', [
                'model' => $model,
                'course' => $course,

            ]);
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
    public function actionEnroll()
    {
        $this->view->params['header'] = 'Курсы';
        $this->view->params['description'] = 'Подать заявку на курс';
        $model = new Invitation();

        if (!Yii::$app->user->isGuest && Yii::$app->request->isAjax && $model->saveInvitation(Yii::$app->request->post()['course_id'])) {
            return true;
        }
        else {
            throw new HttpException(403 ,'Доступ запрещен');
        }


    }
    public function actionTakeReport()
    {
        $model = new UserReport();
        $taken = false;
        $post = Yii::$app->request->post();
        $report['id'] = $post['report_id'];

        if (Yii::$app->request->isAjax && $model->saveUserReport($post)) {
            $taken = true;
            return $this->renderPartial('_report', compact('taken', 'report'));

        }
        return $this->renderPartial('_report', compact('taken', 'report'));

    }
    /**
     * Creates a new Course model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */



}
