<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="page-admin">
    <div class="container">
        <div class="row">
            <div class="col-md-12 page-action">
                <div class="wrapper dfx-btn-grp">
                    <h2 class="dfx-title-sm">Действия</h2>
                    <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'dfx-btn-sm dfx-btn-warning']) ?>
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
                            'name',
                            'surname',
                            'email:email',
                            'reg_date',
                            'spec',
                            'description',
                            [
                                'attribute' => 'Аватар',
                                'format' => 'raw',
                                'value' => function ($data) {
                                    return '<a href="/uploads/' . $data->avatar . '">' . $data->avatar . '</a>';
                                }
                            ],
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>