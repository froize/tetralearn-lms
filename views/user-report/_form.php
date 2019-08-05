<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserReport */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-report-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')
        ->dropDownList($users)->label('Пользователь') ?>

    <?= $form->field($model, 'report_id')
        ->dropDownList($reports)->label('Доклад') ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
