<?php

namespace app\models;

use Yii;
use app\helpers\HelpersFunctions;

/**
 * This is the model class for table "group".
 *
 * @property int $id
 * @property string $name
 *
 * @property CourseGroup[] $courseGroups
 * @property User[] $users
 */
class Gang extends \yii\db\ActiveRecord
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
        return 'gang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['user_ids'], 'integer'],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => \voskobovich\linker\LinkerBehavior::className(),
                'relations' => [
                    'user_ids' => 'users',
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название группы',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourseGroups()
    {
        return $this->hasMany(CourseGroup::className(), ['group_id' => 'id']);
    }

    public function saveGroup()
    {
        $participants_ids = $this->user_ids;
        foreach ($participants_ids as $participant_id) {
            $user = User::findOne($participant_id);
            $user->group_id = $this->id;
            $user->save();
        }
        return $this->save(false);
    }

    public function getuser_group()
    {
        return $this->hasMany(
            User::className(),
            ['id' => 'user_id']
        )->viaTable(
            '{{%user_group}}',
            ['course_id' => 'id']
        );
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['group_id' => 'id']);
    }
}
