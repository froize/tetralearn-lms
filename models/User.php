<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;
use app\helpers\HelpersFunctions;
/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $email
 * @property string $password
 * @property string $reg_date
 * @property int $group_id
 * @property string $spec
 * @property int $is_tutor
 * @property string $avatar
 * @property string $auth_key
 *  * @property string $desc
 *
 * @property Course[] $courses
 * @property UserTask[] $userTasks
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
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
    public function getChatname()
    {
        return User::find()->where(['id' => Yii::$app->user->id])->one()['name'];
    }

    public function getChaticon()
    {
        return 'https://наклейкибум.рф/wp-content/uploads/2017/05/10779_0-450x450.svg_-250x102.png';
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['reg_date'], 'safe'],
            [['group_id', 'is_tutor'], 'integer'],
            [['name', 'surname', 'email', 'password', 'spec', 'avatar', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя пользователя',
            'surname' => 'Фамилия',
            'email' => 'Электронная почта',
            'password' => 'Пароль',
            'reg_date' => 'Дата регистрации',
            'group_id' => 'ID группы',
            'spec' => 'Должность',
            'is_tutor' => 'Преподаватель',
            'avatar' => 'Аватар',
            'description' => 'Коротко о себе',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourses()
    {
        return $this->hasMany(Course::className(), ['tutor_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserTasks()
    {
        return $this->hasMany(UserTask::className(), ['student_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Gang::className(), ['id' => 'group_id']);
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }


    public static function findByLogin($login)
    {
        return static::findOne(['login' => $login]);
    }


    public function getId()
    {
        return $this->getPrimaryKey();
    }


    public function getAuthKey()
    {
        return $this->auth_key;
    }


    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }


    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
    public static function findByEmail($email)
    {
        return  static::findOne(['email' => $email]);
    }

    public function create()
    {
        return $this->save(false);
    }

    public function saveFromVk($uid, $name, $photo)
    {
        $user = User::findOne($uid);
        if($user)
        {
            return Yii::$app->user->login($user);
        }

        $this->id = $uid;
        $this->name = $name;
        $this->photo = $photo;
        $this->create();

        return Yii::$app->user->login($this);
    }
    public function getImage()
    {
        $image = null;

        if($this->avatar)
        {
            return '/uploads/' . $this->avatar;
        }
        else
        {
            return '/img/photo.jpg';
        }
    }
    public function saveUser($fileUrl)
    {
        if($fileUrl != '.')
            $this->avatar = $fileUrl;
        return $this->save(false);
    }

}
