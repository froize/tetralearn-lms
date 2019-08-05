<?php

namespace app\helpers;

use app\models\Synchronization;
use yii\db\ActiveRecord;
use yii\helpers\StringHelper;

class HelpersFunctions
{

    /**
     * Функция для записи в таблицу синхронизации
     *
     * @param ActiveRecord $model     Модель с которой производятся действия
     * @param string $action    Текущее действие (create | update | delete)
     * @return bool
     *
     */
    static function putInSync($model, $action)
    {
        $currentDate = new \DateTime();

        $syncItem = new Synchronization();
        $syncItem->model = StringHelper::basename(get_class($model));
        $syncItem->item_id = $model->id;
        $syncItem->action = $action;
        $syncItem->date = $currentDate->format('Y-m-d H:i:s');
        $syncItem->is_sync = 0;

        if ($syncItem->save())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    static function debug($parametr)
    {
        echo "<pre>";
        print_r($parametr);
        echo "</pre>";
    }
}