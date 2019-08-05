<?php
/**
 * Created by PhpStorm.
 * User: Ali
 * Date: 31.03.2019
 * Time: 12:36
 */

namespace app\modules\admin\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;

class AppAdminController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'denyCallback' => function ($rule, $action) {
                    throw new \Exception('У вас нет доступа к этой странице');
                },
                'only' => ['login', 'logout', 'signup', 'index', 'create', 'view','update','delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'signup'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout', 'index', 'create', 'view','update','delete'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }


}