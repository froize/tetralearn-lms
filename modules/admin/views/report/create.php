<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Report */

$this->params['breadcrumbs'][] = ['label' => 'Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-admin">
    <div class="container">
        <div class="row">
            <div class="col-md-12 page-action">
                <div class="wrapper dfx-btn-grp">
                    <h2 class="dfx-title-sm">Действия</h2>
                    <?= Html::a('Вернуться назад', ['index'], ['class' => 'dfx-btn-sm dfx-btn-default']) ?>
                </div>
            </div>
        </div>

        <?= $this->render('_form', [
            'model' => $model,
            'courses' => $courses,
        ]) ?>

    </div>
</div>
