<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Доклады';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-admin">
    <div class="container">
        <div class="row">
            <div class="col-md-12 page-action">
                <div class="wrapper dfx-btn-grp">
                    <h2 class="dfx-title-sm">Действия</h2>
                    <?= Html::a('Создать', ['create'], ['class' => 'dfx-btn-sm dfx-btn-success']) ?>
<!--                    --><?//= Html::a('Просмотр', ['view', 'id' => $model->id], ['class' => 'dfx-btn-sm dfx-btn-info']) ?>
<!--                    --><?//= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'dfx-btn-sm dfx-btn-warning']) ?>
<!--                    --><?//= Html::a('Удалить', ['delete', 'id' => $model->id], ['class' => 'dfx-btn-sm dfx-btn-error']) ?>
<!--                    --><?//= Html::a('Вернуться назад', ['index'], ['class' => 'dfx-btn-sm dfx-btn-default']) ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 dfx-panel">
                <div class="dfx-panel-wrapper">

                    <div class="panel-header">
                        <h2 class="dfx-title-md">Список докладов</h2>
                    </div>
                    <?= GridView::widget([
                        'dataProvider' => $dataProviderOwnReports,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'id',
                            'title',
                            [
                                'attribute' => 'course.name',
                                'format' => 'raw',
                                'value' => function ($data) {
                                    return $data->course->name;
                                }
                            ],

                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 dfx-panel">
                <div class="dfx-panel-wrapper">

                    <div class="panel-header">
                        <h2 class="dfx-title-md">Взятые доклады</h2>
                    </div>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'id',
                            'user.name',
                            'report.title',
                            'report.course.name',

                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>