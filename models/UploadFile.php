<?php
/**
 * Created by PhpStorm.
 * User: Ali
 * Date: 03.04.2019
 * Time: 15:14
 */

namespace app\models;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadFile extends Model{

    public $file;

    public function rules(){
        return[
            [['file'], 'file', 'extensions' => 'docx, doc, pdf, odt, ppt, pptx, xls, xlsx, jpg, jpeg, png, gif'],
        ];
    }

    public function upload(){
        if($this->validate() && $this->file){
            $this->file->saveAs("uploads/{$this->file->baseName}.{$this->file->extension}");
        }else{
            return false;
        }
    }

}