<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "group".
 *
 * @property int $id
 * @property string $name
 *
 * @property CourseGroup[] $courseGroups
 * @property User[] $users
 */
class GangPs extends \yii\db\ActiveRecord
{
    public static function getDb() {
        return Yii::$app->get('postgredb');
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['group_id' => 'id']);
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
}
