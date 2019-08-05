<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Регистрация пользователя';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-admin">
    <div class="container">

        <?= $this->render('_form', [
            'model' => $model,
            'uploaded_file' => $uploaded_file,
        ]) ?>

    </div>
</div>