<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-md-12 page-action">
        <div class="wrapper dfx-btn-grp">
            <h2 class="dfx-title-sm">Действия</h2>
            <?= Html::a('Просмотр', ['view', 'id' => $model->id], ['class' => 'dfx-btn-sm dfx-btn-info']) ?>
            <?= Html::a('Вернуться назад', ['index'], ['class' => 'dfx-btn-sm dfx-btn-default']) ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 dfx-panel">
        <div class="dfx-panel-wrapper">

            <div class="panel-header">
                <h2 class="dfx-title-md">Пользователь</h2>
            </div>
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

            <?= $form->field($model, 'surname')->textInput(['maxlength' => 255]) ?>

            <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>

            <?= $form->field($model, 'password')->passwordInput(['maxlength' => 255]) ?>

            <?= $form->field($model, 'spec')->textInput(['maxlength' => 255]) ?>

            <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

            <?= $form->field($uploaded_file, 'file')->fileInput()->label('Аватар') ?>


            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'dfx-btn dfx-btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
