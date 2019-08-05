<?php

namespace app\controllers;

use app\models\Course;
use app\models\CoursePs;
use app\models\Invitation;
use app\models\UserPs;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use slavkovrn\chat\controllers;
use app\models\User;
use app\models\UserCourse;
use app\models\Gang;
use app\models\CourseGroup;
use yii\web\HttpException;

class SiteController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'logout', 'signup'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'signup'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $asda = CoursePs::findOne(1);
//        print_r($asda);
        $this->view->params['header'] = 'Курсы';
        $this->view->params['description'] = 'Доступные для вас курсы';
        if(Yii::$app->user->isGuest) {
//            $unavailable_courses = Course::find()
//                ->asArray()
//                ->joinWith('tutor')
//                ->joinWith('invitations')
//                ->all();
//        $user['is_tutor'] = 0;

            return $this->redirect(['login']);
        }
        else {
            $user = User::find()->asArray()->joinWith('group')->where(['user.id' => Yii::$app->user->id])->one();
            $available_course_ids = array();
            $own_courses = Course::find()->asArray()->joinWith('tutor')->where(['tutor_id' => Yii::$app->user->id])->all();
            $i = 0;
            foreach ($own_courses as $own_course) {
                $available_course_ids[] = $own_courses[$i]['id'];
                $i++;
            }
            $courses_participant_ids = UserCourse::find()->asArray()->joinWith('course')->joinWith('user')->where(['user_id' => Yii::$app->user->getId()])->all();
            $participant_in_group_ids = CourseGroup::find()->asArray()->joinWith('course')->joinWith('group')->where(['group_id' => $user['group']['id']])->all();
            $courses_participant = array();
            $participant_in_group = array();
            $i = 0;
            foreach ($courses_participant_ids as $courses_participant_id) {
                $available_course_ids[] = $courses_participant_ids[$i]['course']['id'];
                $i++;
            }
            $i = 0;
            foreach ($participant_in_group_ids as $participant_in_group_id) {
                $available_course_ids[] = $participant_in_group_ids[$i]['course']['id'];
                $i++;
            }
            $available_course_ids = array_unique($available_course_ids);
            $unavailable_courses = Course::find()
                ->joinWith('tutor')
                ->joinWith('invitations')
                ->asArray()
                ->all();

        }



        return $this->render('index', [
//            'own_courses' => $own_courses,
//            'courses_participant' => $courses_participant,
//            'participant_in_group_ids' => $participant_in_group_ids,
            'unavailable_courses' => $unavailable_courses,
            'user' => $user,
        ]);

    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $this->view->params['header'] = 'Логин';
        $this->view->params['description'] = 'Вход в системы';
        $this->layout = 'login';

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            Yii::$app->session->setFlash('login-success');

            return $this->goHome();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        $this->view->params['header'] = 'Выход';
        $this->view->params['description'] = 'Выход из системы';
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $this->view->params['header'] = 'Контакты';
        $this->view->params['description'] = 'Контакты';
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        $this->view->params['header'] = 'О проекте';
        $this->view->params['description'] = '';
        return $this->render('about');
    }

    public function actionPublicCourse()
    {
        $courses = Course::find()->asArray()->where(['is_private' => 0])->all();

        return $this->render('public-course', ['courses' => $courses]);
    }

    public function actionEnroll()
    {
        $this->view->params['header'] = 'Enroll';
        $this->view->params['description'] = 'Enroll';
        $model = new Invitation();
        $course_id = Yii::$app->request->queryParams['course_id'];

        $user = User::find()->asArray()->where(['id' => Yii::$app->user->getId()])->one();
        $user_group = Gang::find()->asArray()->where(['id' => $user['group_id']])->one();
        $available_course_ids = array();
        $own_courses = Course::find()->asArray()->where(['tutor_id' => Yii::$app->user->getId()])->all();
        $i = 0;
        foreach ($own_courses as $own_course) {
            $available_course_ids[] = $own_courses[$i]['id'];
            $i++;
        }
        $courses_participant_ids = UserCourse::find()->asArray()->where(['user_id' => Yii::$app->user->getId()])->all();
        $participant_in_group_ids = CourseGroup::find()->asArray()->where(['group_id' => $user_group['id']])->all();
        $courses_participant = array();
        $participant_in_group = array();
        $i = 0;
        foreach ($courses_participant_ids as $courses_participant_id) {
            $courses_participant[$i] = Course::find()->asArray()->where(['id' => $courses_participant_id['course_id']])->one();
            $available_course_ids[] = $courses_participant[$i]['id'];
            $i++;
        }
        $i = 0;
        foreach ($participant_in_group_ids as $participant_in_group_id) {
            $participant_in_group[$i] = Course::find()->asArray()->where(['id' => $participant_in_group_id['course_id']])->one();
            $available_course_ids[] = $participant_in_group[$i]['id'];
            $i++;
        }
        $available_course_ids = array_unique($available_course_ids);
        $unavailable_courses = Course::find()->select('id')->asArray()->all();
        $i = 0;
        foreach ($unavailable_courses as $unavailable_course) {
            if (in_array($unavailable_course['id'], $available_course_ids)) {
                unset($unavailable_courses[$i]);
            } else {
                $unavailable_courses[$i] = $unavailable_course['id'];
            }
            $i++;
        }


        if ($model->load(Yii::$app->request->post()) && $model->saveInvitation($course_id)) {
            return $this->redirect(['index']);
        }
        if (!Yii::$app->user->isGuest && in_array($course_id, $unavailable_courses)) {
            return $this->render('enroll', ['model' => $model]);
        } else {
            throw new HttpException(403, 'Доступ запрещен');
        }


    }
}
