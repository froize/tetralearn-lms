<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CourseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Активные курсы';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="course-index">
    <!--    --><?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!--    --><? //= GridView::widget([
    //        'dataProvider' => $dataProvider,
    //        'filterModel' => $searchModel,
    //        'columns' => [
    //            ['class' => 'yii\grid\SerialColumn'],
    //
    //            'id',
    //            'name',
    //            'desc:ntext',
    //            'rating',
    //            'start_date',
    //            //'end_date',
    //            //'active',
    //            //'tutor_id',
    //            //'is_private',
    //
    //            ['class' => 'yii\grid\ActionColumn'],
    //        ],
    //    ]); ?>
    <div class="page-courses-list">
        <div class="container">
            <div class="row">
                <?php if (!$user['is_tutor']) : ?>
                    <?php foreach ($available_courses as $item) : ?>
                        <div class="item col-sm-4">
                            <div class="item-wrapper">
                                <div class="img-container">
                                    <div class="category">
                                        <?php if ($item['is_private']): ?>
                                            <span class="private"><i class="far fa-lock"></i></span>
                                        <?php endif; ?>
                                        <span class="name" style="background:#19b5fe;">Базы данных</span>
                                    </div>
                                    <?php if ($item['pic'] != '') : ?>
                                        <img src="/uploads/<?= $item['pic'] ?>" class="dfx-img-rsp"/>
                                    <? else: ?>
                                        <img src="/img/course-1.jpg" class="dfx-img-rsp"/>
                                    <? endif; ?>
                                </div>
                                <div class="course-info">
                                    <h2 class="dfx-title"><?= Html::a($item['name'], ['view', 'id' => $item['id']], ['class' => 'btn btn-primary']) ?></h2>
                                    <div class="course-desc dfx-text"><?php echo \yii\helpers\StringHelper::truncate($item['description'], 150, '...'); ?></div>
                                    <div class="author-info">
                                        <div class="photo">
                                            <?php if ($item['tutor']['avatar'] != '') : ?>
                                                <img src="/uploads/<?= $item['tutor']['avatar'] ?>"
                                                     class="dfx-img-rsp"/>
                                            <? else: ?>
                                                <img src="/img/photo.jpg" class="dfx-img-rsp"/>
                                            <? endif; ?>
                                        </div>
                                        <div class="info">
                                            <span class="name"><?= $item['tutor']['name'] . ' ' . $item['tutor']['surname'] ?></span>
                                            <span class="specialization"><?= $item['tutor']['spec'] ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                <?php endif; ?>
            </div>
        </div>
    </div>

</div>
