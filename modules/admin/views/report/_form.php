<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Report */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-md-12 dfx-panel">
        <div class="dfx-panel-wrapper">

            <div class="panel-header">
                <h2 class="dfx-title-md">Доклад</h2>
            </div>
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'title')->textInput(['maxlength' => true])->label('Название') ?>

            <!--    --><? //= $form->field($model, 'course_id')->textInput() ?>
            <?= $form->field($model, 'course_id')
                ->dropDownList($courses)->label('Курс') ?>


            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'dfx-btn dfx-btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>