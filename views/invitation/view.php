<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Answer */

$this->title = 'Просмотр приглашения';
$this->params['breadcrumbs'][] = ['label' => 'Invitations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
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
                            'course.name',
                            [
                                'attribute' => 'Пользователь',
                                'format' => 'raw',
                                'value' => function ($data) {
                                    return $data->user->name . ' ' . $data->user->surname;
                                }
                            ],
                            'accepted',
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>