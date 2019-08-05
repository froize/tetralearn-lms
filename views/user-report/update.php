<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserReport */

$this->title = 'Изменить взятый доклад: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-report-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'users' => $users,
        'reports' => $reports,
    ]) ?>

</div>
