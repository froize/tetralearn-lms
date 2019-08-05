<?php

namespace app\models;

use Yii;
use app\helpers\HelpersFunctions;

/**
 * This is the model class for table "lecture".
 *
 * @property int $id
 * @property string $name
 * @property string $text
 * @property int $file
 * @property int $chapter_id
 *
 * @property Chapter $chapter
 */
class Lecture extends \yii\db\ActiveRecord
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
        return 'lecture';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['text'], 'string'],
            [['chapter_id'], 'integer'],
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
            'name' => 'Название лекции',
            'text' => 'Текст',
            'file' => 'Файл лекции',
            'chapter_id' => 'ID главы',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChapter()
    {
        return $this->hasOne(Chapter::className(), ['id' => 'chapter_id']);
    }

    public function saveLecture($fileUrl)
    {
        if ($fileUrl != '.')
            $this->file = $fileUrl;
        return $this->save(false);
    }

}
