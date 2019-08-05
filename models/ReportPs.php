<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "report".
 *
 * @property int $id
 * @property string $title
 * @property int $course_id
 *
 * @property Course $course
 * @property UserReport[] $userReports
 */
class ReportPs extends \yii\db\ActiveRecord
{
    public static function getDb() {
        return Yii::$app->get('postgredb');
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'report';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'course_id'], 'required'],
            [['course_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Course::className(), 'targetAttribute' => ['course_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название доклада',
            'course_id' => 'ID курса',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Course::className(), ['id' => 'course_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserReports()
    {
        return $this->hasMany(UserReport::className(), ['report_id' => 'id']);
    }

}
