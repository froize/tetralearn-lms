<?php

namespace app\models;

use Yii;
use app\helpers\HelpersFunctions;

/**
 * This is the model class for table "course_curator".
 *
 * @property int $id
 * @property int $curator_id
 * @property int $course_id
 *
 * @property User $curator
 * @property Course $course
 */
class CourseCurator extends \yii\db\ActiveRecord
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
        return 'course_curator';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['curator_id', 'course_id'], 'integer'],
            [['curator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['curator_id' => 'id']],
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
            'curator_id' => 'Curator ID',
            'course_id' => 'Course ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurator()
    {
        return $this->hasOne(User::className(), ['id' => 'curator_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Course::className(), ['id' => 'course_id']);
    }
}
