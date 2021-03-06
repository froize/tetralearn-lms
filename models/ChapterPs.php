<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "chapter".
 *
 * @property int $id
 * @property string $name
 * @property int $course_id
 *
 * @property Course $course
 * @property Lecture[] $lectures
 */
class ChapterPs extends \yii\db\ActiveRecord
{
    public static function getDb() {
        return Yii::$app->get('postgredb');
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'chapter';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'course_id'], 'required'],
            [['course_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
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
            'name' => 'Название главы',
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
    public function getLectures()
    {
        return $this->hasMany(Lecture::className(), ['chapter_id' => 'id']);
    }
    public function saveChapter()
    {
        return $this->save(false);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['chapter_id' => 'id']);
    }
}
