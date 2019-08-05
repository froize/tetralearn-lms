<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "synchronization".
 *
 * @property int $id
 * @property string $model
 * @property int $item_id
 * @property string $action
 * @property string $date
 * @property int $is_sync
 */
class Synchronization extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'synchronization';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_id', 'is_sync'], 'integer'],
            [['date'], 'safe'],
            [['model'], 'string', 'max' => 255],
            [['action'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'model' => 'Model',
            'item_id' => 'Item ID',
            'action' => 'Action',
            'date' => 'Date',
            'is_sync' => 'Is Sync',
        ];
    }
}
