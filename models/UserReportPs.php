<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_report".
 *
 * @property int $id
 * @property int $user_id
 * @property int $report_id
 *
 * @property User $user
 * @property Report $report
 */
class UserReportPs extends \yii\db\ActiveRecord
{
    public static function getDb() {
        return Yii::$app->get('postgredb');
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_report';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'report_id'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['report_id'], 'exist', 'skipOnError' => true, 'targetClass' => Report::className(), 'targetAttribute' => ['report_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'ID пользователя',
            'report_id' => 'ID доклада',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReport()
    {
        return $this->hasOne(Report::className(), ['id' => 'report_id']);
    }
    public function saveUserReport($data)
    {
        $this->user_id = Yii::$app->user->id;
        $this->report_id = $data['report_id'];
        $this->save();
    }
}
