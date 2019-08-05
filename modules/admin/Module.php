<?php

namespace app\modules\admin;

/**
 * admin module definition class
 */
use Yii;
use yii\i18n\PhpMessageSource;

class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $layout = '/admin';
    public $controllerNamespace = 'app\modules\admin\controllers';
    public $numberLastMessages = 22;
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        $this->registerTranslations();
        // custom initialization code goes here
    }
    public function beforeAction($action)
    {

        if (!parent::beforeAction($action))
        {
            return false;
        }

        if (!Yii::$app->user->isGuest)
        {
            return true;
        }
        else
        {
            Yii::$app->getResponse()->redirect(Yii::$app->getHomeUrl());
            //для перестраховки вернем false
            return false;
        }
    }
    protected function registerTranslations()
    {
        Yii::$app->get('i18n')->translations['chat'] = [
            'class' => PhpMessageSource::class,
            'basePath' => __DIR__ . '/messages',
            'sourceLanguage' => (isset(Yii::$app->language))?Yii::$app->language:'en',
            'forceTranslation' => true,
        ];
    }

}
