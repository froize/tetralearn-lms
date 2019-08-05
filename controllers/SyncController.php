<?php

namespace app\controllers;

use app\helpers\HelpersFunctions;
use app\models\Synchronization;
use yii\db\ActiveRecord;

class SyncController extends \yii\web\Controller
{
    /**
     *
     * Основная функция для синхронизации
     *
     */
    public function actionIndex($token)
    {
        if ($token) {
            if ($token == 'tetra') {
                $syncQueue = Synchronization::find()
                    ->where([
                        'is_sync' => 0
                    ])
                    ->orderBy(['id' => SORT_ASC])
                    ->all();

                if ($syncQueue) {
                    foreach ($syncQueue as $syncItem) {
                        /** @var Synchronization $syncItem */
                        /** @var ActiveRecord $postgreItem */

                        $modelName = $this->getModelName($syncItem->model);
                        $postgreModelName = $this->getModelName($syncItem->model, true);

                        switch ($syncItem->action) {
                            case 'create':

                                $createdItem = $modelName::findOne($syncItem->item_id);
                                HelpersFunctions::debug($createdItem->attributes);
                                if ($createdItem) {
                                    $postgreItem = new $postgreModelName();
                                    $postgreItem->attributes = $createdItem->attributes;

                                    if ($postgreItem->save(false)) {
                                        $syncItem->is_sync = 1;
                                        $syncItem->save();
                                    }
                                }
                                else
                                {
                                    $postgreItem = new $postgreModelName();

                                    if ($postgreItem->save(false))
                                    {
                                        $syncItem->is_sync = 1;
                                        $syncItem->save();
                                    }
                                }

                                break;

                            case 'update':

                                $updatedItem = $modelName::findOne($syncItem->item_id);

                                if ($updatedItem) {
                                    $postgreItem = $postgreModelName::findOne($syncItem->item_id);
                                    $postgreItem->attributes = $updatedItem->attributes;

                                    if ($postgreItem->save(false)) {
                                        $syncItem->is_sync = 1;
                                        $syncItem->save();
                                    }
                                }

                                break;

                            case 'delete':

                                $itemToDelete = $postgreModelName::findOne($syncItem->item_id);

//                                \app\helpers\HelpersFunctions::debug($itemToDelete);

                                if ($itemToDelete) {
                                    if ($itemToDelete->delete(false)) {
                                        $syncItem->is_sync = 1;
                                        $syncItem->save();
                                    }
                                }

                                break;
                        }
                    }
                }
            }
        }

        return false;
    }


    /**
     * Функция возвращает полное имя модели
     *
     * @param string $model_name Название модели для поиска
     * @return ActiveRecord | string
     *
     */
    private function getModelName($model_name, $isPostgre = false)
    {
        return 'app\\models\\' . $model_name . ($isPostgre ? 'Ps' : '');
    }
}
