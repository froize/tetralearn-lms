<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CourseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Доступные курсы';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if ($user['is_tutor'] == 1) : ?>
    <?php
    $this->title = 'Панель администрирования';
    $this->params['header'] = 'Панель администрирования';
    $this->params['description'] = 'Быстрый доступ к редактированию всех модулей';
    ?>
    <div class="page-admin-index">
        <div class="container">
            <div class="links-container">
                <div class="row">
                    <div class="col-md-6 item">
                        <a href="">
                            <div class="wrapper">
                                <div class="icon-container">
                                    <i class="fal fa-file clr-red"></i>
                                </div>
                                <div class="content">
                                    <h3 class="name dfx-title-sm"><?= Html::a('Мои курсы', ['/admin/course']) ?></h3>
                                    <p class="desc">Создание, изменение курсов</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 item">
                        <a href="">
                            <div class="wrapper">
                                <div class="icon-container">
                                    <i class="fal fa-heading clr-blue"></i>
                                </div>
                                <div class="content">
                                    <h3 class="name dfx-title-sm"><?= Html::a('Мои главы', ['/admin/chapter']) ?></h3>
                                    <p class="desc">Создание, изменение глав</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 item">
                        <a href="">
                            <div class="wrapper">
                                <div class="icon-container">
                                    <i class="fal fa-book-open clr-orange"></i>
                                </div>
                                <div class="content">
                                    <h3 class="name dfx-title-sm"><?= Html::a('Мои лекции', ['/admin/lecture']) ?></h3>
                                    <p class="desc">Создание, изменение лекций</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 item">
                        <a href="">
                            <div class="wrapper">
                                <div class="icon-container">
                                    <i class="fal fa-tasks clr-orange"></i>
                                </div>
                                <div class="content">
                                    <h3 class="name dfx-title-sm"><?= Html::a('Мои задания', ['/admin/task']) ?></h3>
                                    <p class="desc">Создание, изменение заданий</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 item">
                        <a href="">
                            <div class="wrapper">
                                <div class="icon-container">
                                    <i class="fal fa-pencil clr-prpl"></i>
                                </div>
                                <div class="content">
                                    <h3 class="name dfx-title-sm"><?= Html::a('Заявки', ['/admin/invitation']) ?></h3>
                                    <p class="desc">Создание, изменение заявок</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 item">
                        <a href="">
                            <div class="wrapper">
                                <div class="icon-container">
                                    <i class="fal fa-file-alt clr-green"></i>
                                </div>
                                <div class="content">
                                    <h3 class="name dfx-title-sm"><?= Html::a('Доклады', ['/admin/report']) ?></h3>
                                    <p class="desc">Создание, изменение докладов</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 item">
                        <a href="">
                            <div class="wrapper">
                                <div class="icon-container">
                                    <i class="fal fa-file-check clr-brown"></i>
                                </div>
                                <div class="content">
                                    <h3 class="name dfx-title-sm"><?= Html::a('Оценки', ['/admin/grade']) ?></h3>
                                    <p class="desc">Создание, изменение оценок</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 item">
                        <a href="">
                            <div class="wrapper">
                                <div class="icon-container">
                                    <i class="fal fa-users clr-blue"></i>
                                </div>
                                <div class="content">
                                    <h3 class="name dfx-title-sm"><?= Html::a('Группы', ['/admin/group']) ?></h3>
                                    <p class="desc">Создание, изменение групп</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="page-courses-list">
        <div class="container">
            <div class="row">

                <!--            --><?php //if(!$user['is_tutor']) :?>
                <!--            --><?php //foreach ($participant_in_group_ids as $item) : ?>
                <!--                <div class="item col-sm-4">-->
                <!--                    <div class="item-wrapper">-->
                <!--                        <div class="img-container">-->
                <!--                            <div class="category">-->
                <!--                                --><?php //if($item['course']['is_private']):?>
                <!--                                    <span class="private"><i class="far fa-lock"></i></span>-->
                <!--                                --><?php //endif;?>
                <!--                                <span class="name" style="background:#19b5fe;">Базы данных</span>-->
                <!--                            </div>-->
                <!--                            <img src="/img/course-1.jpg" class="dfx-img-rsp"/>-->
                <!--                        </div>-->
                <!--                        <div class="course-info">-->
                <!--                            <h2 class="dfx-title">-->
                <? //=Html::a($item['course']['name'], ['course/view', 'id' => $item['course']['id']], ['class' => 'btn btn-primary']) ?><!--</h2>-->
                <!--                            <p class="course-desc dfx-text">-->
                <?php //echo \yii\helpers\StringHelper::truncate($item['course']['description'],150,'...'); ?><!--</p>-->
                <!--                            <div class="author-info">-->
                <!--                                <div class="photo">-->
                <!--                                    <img src="/img/photo.jpg" class="dfx-img-rsp"/>-->
                <!--                                </div>-->
                <!--                                <div class="info">-->
                <!--                                    <span class="name">-->
                <? //=$item['tutor']['name'].' '.$item['tutor']['surname']?><!--</span>-->
                <!--                                    <span class="specialization">-->
                <? //=$item['tutor']['spec']?><!--</span>-->
                <!--                                </div>-->
                <!--                            </div>-->
                <!--                        </div>-->
                <!--                    </div>-->
                <!--                </div>-->
                <!--            --><?php //endforeach;?>
                <!--            --><?php //foreach ($courses_participant as $item) : ?>
                <!--                <div class="item col-sm-4">-->
                <!--                    <div class="item-wrapper">-->
                <!--                        <div class="img-container">-->
                <!--                            <div class="category">-->
                <!--                                --><?php //if($item['is_private']):?>
                <!--                                    <span class="private"><i class="far fa-lock"></i></span>-->
                <!--                                --><?php //endif;?>
                <!--                                <span class="name" style="background:#19b5fe;">Базы данных</span>-->
                <!--                            </div>-->
                <!--                            <img src="/img/course-1.jpg" class="dfx-img-rsp"/>-->
                <!--                        </div>-->
                <!--                        <div class="course-info">-->
                <!--                            <h2 class="dfx-title">--><? //=$item['name']?><!--</h2>-->
                <!--                            <p class="course-desc dfx-text">-->
                <?php //echo \yii\helpers\StringHelper::truncate($item['description'],150,'...'); ?><!--</p>-->
                <!--                            <div class="author-info">-->
                <!--                                <div class="photo">-->
                <!--                                    <img src="/img/photo.jpg" class="dfx-img-rsp"/>-->
                <!--                                </div>-->
                <!--                                <div class="info">-->
                <!--                                    <span class="name">-->
                <? //=$item['tutor']['name'].' '.$item['tutor']['surname']?><!--</span>-->
                <!--                                    <span class="specialization">-->
                <? //=$item['tutor']['spec']?><!--</span>-->
                <!--                                </div>-->
                <!--                            </div>-->
                <!--                        </div>-->
                <!--                    </div>-->
                <!--                </div>-->
                <!--            --><?php //endforeach;?>
                <?php foreach ($unavailable_courses as $item) : ?>
                    <?php if (!$item['is_private']): ?>
                        <div class="item col-sm-4">
                            <div class="item-wrapper">
                                <div class="img-container">
                                    <div class="category">
                                        <span class="name" style="background:#19b5fe;">Программирование</span>
                                        <span class="name"
                                              style="background:#cc0000;">
                                            <?php if ($item['invitations'] != array()): ?>
                                                <?php foreach ($item['invitations'] as $invitation) : ?>
                                                    <?php if ($invitation['user_id'] == Yii::$app->user->id): ?>
                                                        Заявка отправлена
                                                    <? endif; ?>
                                                <?php endforeach; ?>
                                            <? else: ?>
                                                Требуется заявка
                                            <? endif; ?>
                                        </span>
                                    </div>
                                    <?php if ($item['pic'] != '') : ?><img src="/uploads/<?= $item['pic'] ?>"
                                                                           class="dfx-img-rsp"/><? else: ?>
                                        <img src="/img/course-1.jpg" class="dfx-img-rsp"/><? endif; ?>
                                </div>
                                <div class="course-info">
                                    <h2 class="dfx-title"><?= Html::a($item['name'], ['course/view', 'id' => $item['id']], ['class' => 'btn btn-primary']) ?></h2>
                                    <div class="course-desc dfx-text"><?php echo \yii\helpers\StringHelper::truncate($item['description'], 150, '...'); ?></div>
                                    <div class="author-info">
                                        <div class="photo">
                                            <img src="<?php echo ($item['tutor']['avatar'] != '') ? ("/uploads/" . $item['tutor']['avatar']) : ("/img/photo.jpg") ?>"
                                                 class="dfx-img-rsp"/>
                                        </div>
                                        <div class="info">
                                            <span class="name"><?= $item['tutor']['name'] . ' ' . $item['tutor']['surname'] ?></span>
                                            <span class="specialization"><?= $item['tutor']['spec'] ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
                <!--            --><?php //endif;?>
            </div>
        </div>
    </div>
<?php endif; ?>
<div class="course-index">

    <!--    <h1>--><? //= Html::encode($this->title) ?><!--</h1>-->
    <!---->
    <!--    <p>-->
    <!--        --><? //= Html::a('Создать курс', ['add'], ['class' => 'btn btn-success']) ?>
    <!--    </p>-->

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
    <!--    <h2>Ваши созданные курсы</h2>-->
    <!--    --><?php //foreach ($own_courses as $own_course) : ?>
    <!--        <p><a href="/admin/course/view?id=--><? //=$own_course['id']?><!--">-->
    <? //=$own_course['name']?><!--</a></p>-->
    <!--    --><?php //endforeach;?>
    <!--    <h2>Курсы, где вы добавлены в качестве участника группы</h2>-->
    <!--    --><?php //foreach ($participant_in_group_ids as $item) : ?>
    <!--        <p> <a href="/admin/course/view?id=--><? //=$item['id']?><!--">--><? //=$item['name']?><!--</a></p>-->
    <!--    --><?php //endforeach;?>
    <!--    <h2>Курсы, где вы добавлены в качестве отдельного пользователя</h2>-->
    <!--    --><?php //foreach ($courses_participant as $item) : ?>
    <!--        <p><a href="/admin/course/view?id=--><? //=$item['id']?><!--">--><? //=$item['name']?><!--</a></p>-->
    <!--    --><?php //endforeach;?>

</div>
