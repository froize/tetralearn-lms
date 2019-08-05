<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "invitation".
 *
 * @property int $id
 * @property int $course_id
 * @property int $user_id
 * @property int $accepted
 *
 * @property Course $course
 * @property User $user
 */
class InvitationPs extends \yii\db\ActiveRecord
{
    public static function getDb() {
        return Yii::$app->get('postgredb');
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'invitation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['course_id', 'user_id'], 'required'],
            [['course_id', 'user_id','accepted'], 'integer'],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Course::className(), 'targetAttribute' => ['course_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'user_id' => 'ID пользователя',
            'accepted' => 'Принят'

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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    public function saveInvitation($course_id)
    {
        $this->course_id = $course_id;
        $this->user_id = Yii::$app->user->id;
        return $this->save();
    }
    public function saveInvitationAndAccept()
    {
        if($this->accepted) {
            $participant = new UserCourse();
            $participant->user_id = $this->user_id;
            $participant->course_id = $this->course_id;
            $participant->save();
        }
        else {
            $user_course = UserCourse::find()
                ->where([
                    'user_id' => $this->user_id,
                    'course_id' => $this->course_id,
                ])
                ->one();
            $model = UserCourse::findOne($user_course['id']);
            $model->delete();
        }
        return $this->save();
    }
}
