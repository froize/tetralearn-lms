<?php

namespace app\models;

use Yii;
use app\helpers\HelpersFunctions;

/**
 * This is the model class for table "course_group".
 *
 * @property int $id
 * @property int $course_id
 * @property int $group_id
 *
 * @property Gang $group
 * @property Course $course
 */
class CourseGroup extends \yii\db\ActiveRecord
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
        return 'course_group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['course_id', 'group_id'], 'integer'],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gang::className(), 'targetAttribute' => ['group_id' => 'id']],
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
            'course_id' => 'ID курса',
            'group_id' => 'ID группы',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Gang::className(), ['id' => 'group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Course::className(), ['id' => 'course_id']);
    }
}
