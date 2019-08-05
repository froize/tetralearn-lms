<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Gang */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-md-12 dfx-panel">
        <div class="dfx-panel-wrapper">

            <div class="panel-header">
                <h2 class="dfx-title-md">Группа</h2>
            </div>
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>


            <?= $form->field($model, 'user_ids')
                ->dropDownList($participants_users, ['multiple' => true])->label('Студенты') ?>

            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'dfx-btn dfx-btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>