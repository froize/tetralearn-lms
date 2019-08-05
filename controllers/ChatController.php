<?php

namespace app\controllers;

use app\models\Dialog;
use Yii;
use yii\web\Controller;
use app\models\Chat;
use app\models\Task;
use app\models\Chapter;
use app\models\Course;
use app\models\CourseGroup;
use app\models\Gang;
use app\models\User;
use app\models\UserCourse;
use yii\web\HttpException;

/**
 * Default controller for the `chat` module
 */
class ChatController extends SiteController
{

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $this->view->params['header'] = 'Чат';
        $this->view->params['description'] = 'Общение с преподавателем';
        $className = Yii::$app->getUser()->identityClass;
        $model = new $className;
        $user_id = Yii::$app->user->getId();
        $dialog_id = Yii::$app->request->queryParams['dialog_id'];
        $dialog_id = Dialog::find()->asArray()->where(['id'=> $dialog_id])->one();
        if(($dialog_id['student_id']!= $user_id) && ($dialog_id['tutor_id'] != $user_id)) {
            $dialog_id = 0;
        }
        else {
            $dialog_id = $dialog_id['id'];
        }
        $dialogs = Dialog::find()->asArray()->where(['student_id'=> $user_id])->all();
        $dialogs_messages = array();
        $k =0 ;
        foreach ($dialogs as $dialog) {
            $dialogs_messages[$k] = Chat::getMessages(Chat::$numberLastMessages, $dialog['id']);
            $k++;
        }

        if($dialog_id != 0) {
            $messages = Chat::getMessages(Chat::$numberLastMessages, $dialog_id);
            return $this->render('index',compact('user','messages', 'dialog_id', 'dialogs', 'dialogs_messages'));
        }

        else {
            $messages = Chat::getMessages(Chat::$numberLastMessages, $dialog_id);
            return $this->render('index',compact('user','messages', 'dialog_id', 'dialogs', 'dialogs_messages'));
        }


    }

    public function actionSendMessage()
    {
        if (Yii::$app->user->isGuest)
            return 'Registered can chat only';


        $model = new Chat();
        if ($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $post = Yii::$app->request->post();

            if ($post['sendMessage']=='true')
            {
                $model->saveChat(Yii::$app->request->queryParams['dialog_id']);
            }
        }

        $messages = Chat::getMessages($this->module->numberLastMessages, Yii::$app->request->queryParams['dialog_id']);

        return $this->renderPartial('_table',compact('messages'));
    }
}
