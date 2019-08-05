<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UserTask */

$this->title = 'Просмотр оценки';
$this->params['breadcrumbs'][] = ['label' => 'User Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="page-admin">
    <div class="container">
        <div class="row">
            <div class="col-md-12 page-action">
                <div class="wrapper dfx-btn-grp">
                    <h2 class="dfx-title-sm">Действия</h2>
                    <?= Html::a('Создать', ['create'], ['class' => 'dfx-btn-sm dfx-btn-success']) ?>
                    <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'dfx-btn-sm dfx-btn-warning']) ?>
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
        <div class="row">
            <div class="col-md-12 dfx-panel">
                <div class="dfx-panel-wrapper">

                    <div class="panel-header">
                        <h2 class="dfx-title-md"><?= $this->title ?></h2>
                    </div>
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            'task.name',
                            [
                                'attribute' => 'Студент',
                                'format' => 'raw',
                                'value' => function ($data) {
                                    return $data->student->name . ' ' . $data->student->surname;
                                }
                            ],
                            [
                                'attribute' => 'Файл задания',
                                'format' => 'raw',
                                'value' => function ($data) {
                                    return '<a href="/uploads/' . $data->file . '">' . $data->file . '</a>';
                                }
                            ],
                            'grade',
                            'date',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>