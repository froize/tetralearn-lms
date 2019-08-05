<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserTaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Оценки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-admin">
    <div class="container">
        <div class="row">
            <div class="col-md-12 dfx-panel">
                <div class="dfx-panel-wrapper">

                    <div class="panel-header">
                        <h2 class="dfx-title-md">Оценки</h2>
                    </div>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'id',
                            'task.name',
                            [
                                'attribute' => 'Пользователь',
                                'format' => 'raw',
                                'value' => function ($data) {
                                    return $data->student->name . ' ' . $data->student->surname;
                                }
                            ],
                            'grade',
                            'date',
                            ['class' => 'yii\grid\ActionColumn',
                                'template' => '{view}',
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!---->
<!--    --><?php //for ($i = 0; $i<count($courses); $i++) :?>
<!--    --><?php //$points = 0;?>
<!--        <br/>Курс:  --><?//=$courses[$i]['name']?><!--<br/>-->
<!---->
<!--        --><?php //for ($j = 0; $j<count($courses[$i]['chapters']); $j++)  :?>
<!---->
<!--            Глава: --><?//=$courses[$i]['chapters'][$j]['name']?><!--<br/>-->
<!---->
<!--            --><?php //for ($k = 0; $k<count($courses[$i]['chapters'][$j]['tasks'][0]); $k++) :?>
<!---->
<!--                Задание: --><?//=$courses[$i]['chapters'][$j]['tasks'][0][$k]['name']?><!-- Баллы: --><?//=$courses[$i]['chapters'][$j]['tasks'][0][$k]['userTasks'][0]['grade']?><!--<br/>-->
<!--                --><?php //$points+=$courses[$i]['chapters'][$j]['tasks'][0][$k]['userTasks'][0]['grade']?>
<!---->
<!---->
<!--            --><?php //endfor;?>
<!---->
<!--        --><?php //endfor;?>
<!--        Сумма баллов: --><?//=$points?>
<!--    --><?php //endfor; ;?>
