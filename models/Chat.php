<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%chat3}}".
 *
 * @property string $id
 * @property string $user_id
 * @property string $time
 * @property string $rfc822
 * @property string $message
 * @property string $name
 * @property string $icon
 * @property string $dialog_id
 */
class Chat extends \yii\db\ActiveRecord
{
    static public $numberLastMessages = 20;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%chat}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','user_id','time', 'dialog_id'], 'integer'],
            [['rfc822'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 255],
            [['icon'], 'string', 'max' => 255],
            [['message'], 'string'],
            [['name','icon','message'], 'safe'],
            [['dialog_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dialog::className(), 'targetAttribute' => ['dialog_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'icon' => 'Icon',
            'message' => 'Message',
            'dialog_id' => 'Dialog ID',
        ];
    }

    public static function getMessages($numberLastMessages, $dialog_id)
    {
            if($dialog_id != 0) {
                $messages = self::find()
                    ->orderBy('time DESC')
                    ->where(['dialog_id'=>$dialog_id])
                    ->limit($numberLastMessages)
                    ->all();
                $out=[];
                foreach ($messages as $message)
                {
                    $out[$message['time']]=[
                        'rfc822' => $message['rfc822'],
                        'name' => $message['name'],
                        'icon' => $message['icon'],
                        'message' => $message['message'],
                    ];
                }
                ksort($out);
                return $out;
            }
            else {
                $messages = self::find()
                    ->orderBy('time DESC')
                    ->where(['dialog_id'=>$dialog_id])
                    ->limit($numberLastMessages)
                    ->all();
                $out=[];
                foreach ($messages as $message)
                {
                    $out[$message['time']]=[
                        'rfc822' => $message['rfc822'],
                        'name' => $message['name'],
                        'icon' => $message['icon'],
                        'message' => $message['message'],
                    ];
                }
                ksort($out);
                return $out;
            }

    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDialog()
    {
        return $this->hasOne(Dialog::className(), ['id' => 'dialog_id']);
    }
    public function saveChat($data)
    {
        $this->time = time();
        $this->rfc822 = date(DATE_RFC822,$this->time);

        $this->user_id = Yii::$app->user->getId();
        $this->name = User::find()->asArray()->where(['id'=>$this->user_id])->one()['name'];
        $this->dialog_id = $data['dialog_id'];
        $this->icon = $data['icon'];
        $this->message = $data['message'];
        return $this->save();
    }

}
