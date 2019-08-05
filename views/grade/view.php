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
</div>
<div class="page-admin">
    <div class="container">
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
                                'attribute' => 'Отправленный файл',
                                'format' => 'raw',
                                'value' => function ($data) {
                                    return '<a href="/uploads/'. $data->file .'">' . $data->file . '</a>';
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