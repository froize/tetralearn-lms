<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserReport */

$this->title = 'Добавить докладчика';
$this->params['breadcrumbs'][] = ['label' => 'User Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-report-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'users' => $users,
        'reports' => $reports,
    ]) ?>

</div>
