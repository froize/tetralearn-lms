<?php

namespace app\models;

use app\helpers\HelpersFunctions;
use Yii;

/**
 * This is the model class for table "course".
 *
 * @property int $id
 * @property string $name
 * @property string $desc
 * @property double $rating
 * @property string $start_date
 * @property string $end_date
 * @property string $pic
 * @property int $active
 * @property int $tutor_id
 * @property int $is_private
 *
 * @property Chapter[] $chapters
 * @property User $tutor
 */
class Course extends \yii\db\ActiveRecord
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
        return 'course';
    }

    /**
     * {@inheritdoc}
     *
     * .on("change", function() {
     * $('.reg').slideToggle();
     * });
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['description'], 'string'],
            [['rating'], 'number'],
            [['start_date', 'end_date'], 'safe'],
            [['active', 'tutor_id', 'is_private'], 'integer'],
            [['name', 'pic'], 'string', 'max' => 255],
            [['tutor_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['tutor_id' => 'id']],
            [['user_ids', 'group_ids', 'curator_ids'], 'integer'],
        ];

    }

    public function behaviors()
    {
        return [
            [
                'class' => \voskobovich\linker\LinkerBehavior::className(),
                'relations' => [
                    'user_ids' => 'user_course',
                    'group_ids' => 'course_group',
                    'curator_ids' => 'course_curator',
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
            'name' => 'Название курса',
            'description' => 'Описание',
            'rating' => 'Рейтинг',
            'start_date' => 'Дата начала',
            'end_date' => 'Дата окончания',
            'active' => 'Активный',
            'tutor_id' => 'ID преподавателя',
            'is_private' => 'Приватный',
            'pic' => 'Изображение',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChapters()
    {
        return $this->hasMany(Chapter::className(), ['course_id' => 'id']);
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
    public function getCourseCurators()
    {
        return $this->hasMany(CourseCurator::className(), ['course_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourseGroups()
    {
        return $this->hasMany(CourseGroup::className(), ['course_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvitations()
    {
        return $this->hasMany(Invitation::className(), ['course_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReports()
    {
        return $this->hasMany(Report::className(), ['course_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserCourses()
    {
        return $this->hasMany(UserCourse::className(), ['course_id' => 'id']);
    }

    public function saveCourse($fileUrl)
    {
        $this->tutor_id = Yii::$app->user->id;
        if ($fileUrl != '.')
            $this->pic = $fileUrl;
        return $this->save(false);
    }

    public function getuser_course()
    {
        return $this->hasMany(
            User::className(),
            ['id' => 'user_id']
        )->viaTable(
            '{{%user_course}}',
            ['course_id' => 'id']
        );
    }

    public function getcourse_group()
    {
        return $this->hasMany(
            Gang::className(),
            ['id' => 'group_id']
        )->viaTable(
            '{{%course_group}}',
            ['course_id' => 'id']
        );
    }

    public function getcourse_curator()
    {
        return $this->hasMany(
            User::className(),
            ['id' => 'curator_id']
        )->viaTable(
            '{{%course_curator}}',
            ['course_id' => 'id']
        );
    }
}
