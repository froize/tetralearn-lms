<?php

namespace app\models;

use Yii;


/**
 * This is the model class for table "user_task".
 *
 * @property int $id
 * @property int $task_id
 * @property int $student_id
 * @property string $file
 * @property int $grade
 * @property string $date
 *
 * @property User $student
 * @property Task $task
 */
class UserTaskPs extends \yii\db\ActiveRecord
{
    public static function getDb() {
        return Yii::$app->get('postgredb');
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task_id', 'student_id', 'grade'], 'integer'],
            [['date'], 'safe'],
            [['file'], 'string'],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['student_id' => 'id']],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['task_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'task_id' => 'ID задания',
            'student_id' => 'ID студента',
            'file' => 'Файл',
            'grade' => 'Оценка',
            'date' => 'Дата',
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
    public function getTask()
    {
        return $this->hasOne(Task::className(), ['id' => 'task_id']);
    }
    public function saveUserTask($task_id, $fileUrl)
    {
        $this->student_id = Yii::$app->user->id;
        $this->task_id = $task_id;
        $this->date = date('Y-m-d H:i:s');
        if($fileUrl != '.')
            $this->file = $fileUrl;
        $this->save(false);
    }
}
