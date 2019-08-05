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

                            ['class' => 'yii\grid\ActionColumn',
                                'template' => '{delete}',
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>