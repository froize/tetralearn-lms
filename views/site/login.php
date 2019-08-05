<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="container-login100">
    <div class="wrap-login100">

        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'options' => ['class' => 'login100-form'],
        ]) ?>

        <div class="logo-container">
            <img src="/img/logo-sm.svg" class="dfx-img-rsp"/>
        </div>

        <span class="login100-form-title">
						Авторизация
					</span>

        <?= $form->field($model, 'email', [
            'template' => '<div class="wrap-input100">{input}<span class="symbol-input100"><i class="fa fa-envelope" aria-hidden="true"></i></span><span class="error">{error}</span></div>'
        ])->textInput(['class' => 'input100', 'placeholder' => 'Электронная почта'])->label(false); ?>

        <?= $form->field($model, 'password', [
            'template' => '<div class="wrap-input100">{input}<span class="symbol-input100"><i class="fa fa-lock" aria-hidden="true"></i></span><span class="error">{error}</span></div>'
        ])->passwordInput(['class' => 'input100', 'placeholder' => 'Пароль'])->label(false); ?>


        <div class="container-login100-form-btn">
            <?= Html::submitButton('Войти', ['class' => 'dfx-btn dfx-btn-success', 'name' => 'login-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>