<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserTask */

$this->title = 'Изменить оценку';
$this->params['breadcrumbs'][] = ['label' => 'User Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="page-admin">
    <div class="container">
        <div class="row">
            <div class="col-md-12 page-action">
                <div class="wrapper dfx-btn-grp">
                    <h2 class="dfx-title-sm">Действия</h2>
                    <?= Html::a('Просмотр', ['view', 'id' => $model->id], ['class' => 'dfx-btn-sm dfx-btn-info']) ?>
                    <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                        'class' => 'dfx-btn-sm dfx-btn-error',
                        'data' => [
                            'confirm' => 'Вы уверены, что хотите это удалить?',
                            'method' => 'post',
                        ],
                    ]) ?>
                    <?= Html::a('Вернуться назад', ['index'], ['class' => 'dfx-btn-sm dfx-btn-default']) ?>

                </div>
            </div>
        </div>

        <?= $this->render('_form', [
            'model' => $model,
            'tasks_list' => $tasks_list,
            'users' => $users,
        ]) ?>

    </div>
</div>
