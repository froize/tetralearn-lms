<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserReportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Reports';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-report-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User Report', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'report_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
