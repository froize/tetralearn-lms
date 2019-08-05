<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dialog".
 *
 * @property int $id
 * @property int $tutor_id
 * @property int $student_id
 * @property int $task_id
 *
 * @property User $student
 * @property User $tutor
 * @property Task $task
 */
class Dialog extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dialog';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tutor_id', 'student_id', 'task_id'], 'integer'],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['student_id' => 'id']],
            [['tutor_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['tutor_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tutor_id' => 'ID преподавателя',
            'student_id' => 'ID студента',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(User::className(), ['id' => 'student_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTutor()
    {
        return $this->hasOne(User::className(), ['id' => 'tutor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Task::className(), ['id' => 'task_id']);
    }
    public function saveDialog($tutor_id, $student_id, $task_id)
    {
        $this->tutor_id = $tutor_id;
        $this->student_id = $student_id;
        $this->task_id = $task_id;
        return $this->save(false);
    }

}
