<?php

namespace app\models;

use Yii;
use app\helpers\HelpersFunctions;
/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property string $name
 * @property string $text
 * @property string $add_date
 * @property string $start_date
 * @property string $end_date
 * @property int $active
 * @property int $with_deadline
 * @property int $max_points
 * @property string $file
 * @property int $chapter_id
 *
 * @property Chat[] $chats
 * @property Dialog[] $dialogs
 * @property Chapter $chapter
 * @property UserTask[] $userTasks
 */
class Task extends \yii\db\ActiveRecord
{
    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            HelpersFunctions::putInSync($this, 'create');
        } else {
            HelpersFunctions::putInSync($this, 'update');
        }
        parent::afterSave($insert, $changedAttributes);
    }

    public function afterDelete()
    {
        HelpersFunctions::putInSync($this, 'delete');
        parent::afterDelete();
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'text'], 'required'],
            [['text'], 'string'],
            [[ 'active', 'with_deadline', 'max_points', 'chapter_id'], 'integer'],
            [['add_date', 'start_date', 'end_date'], 'datetime', 'format' => 'php:Y-m-d HH:mm:ss'],
            [['name', 'file'], 'string', 'max' => 255],
            [['chapter_id'], 'exist', 'skipOnError' => true, 'targetClass' => Chapter::className(), 'targetAttribute' => ['chapter_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название задания',
            'text' => 'Текст',
            'add_date' => 'Дата добавления',
            'start_date' => 'Дата начала',
            'end_date' => 'Дата окончания',
            'active' => 'Активно',
            'with_deadline' => 'Со сроком',
            'chapter_id' => 'ID главы',
            'file' => 'Файл задания',
            'max_points' => 'Максимальное количество баллов',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnswers()
    {
        return $this->hasMany(Answer::className(), ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDialogs()
    {
        return $this->hasMany(Dialog::className(), ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChats()
    {
        return $this->hasMany(Chat::className(), ['task_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChapter()
    {
        return $this->hasOne(Chapter::className(), ['id' => 'chapter_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserTasks()
    {
        return $this->hasMany(UserTask::className(), ['task_id' => 'id']);
    }

    public function saveTask($fileUrl)
    {
        if($fileUrl != '.')
            $this->file = $fileUrl;
        $this->add_date = date('Y-m-d H:i:s');
        return $this->save(false);
    }

    static function timeToStart($bet_start_date)
    {
        $startDate = \DateTime::createFromFormat('Y-m-d H:i:s', $bet_start_date);

        if ($startDate > new \DateTime('now')) {
            $timeLeft = date_diff(new \DateTime(), $startDate);

            $days = $timeLeft->d;
            $hrs = $timeLeft->h;
            $min = $timeLeft->i;

            if ($days > 0) {
                return $days . ' дн. ' . $hrs . ' часов';
            }

            return $hrs . 'ч ' . $min . 'мин';
        } else {
            return 'Прямо сейчас';
        }
    }

}
