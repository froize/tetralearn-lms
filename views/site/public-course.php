<?php

/* @var $this yii\web\View */
use app\models\Course;
$this->title = 'Публичные курсы';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Публичные курсы</h1>

<!--        <p class="lead">Система, вышедшая на замену почившему imkn.ru/grades.</p>-->

<!--        <p><a class="btn btn-lg btn-success" href="admin/default/index">Админ панель</a></p>-->
    </div>

    <div class="body-content">

        <div class="row">
            <?php //debug($courses);?>
            <?php foreach ($courses as $course): ?>
            <div class="col-lg-4">
                <h2><?=$course['name'] ?></h2>
                <ins>Рейтинг: <?=$course['rating'] ?></ins>
                <p><?=$course['description'] ?></p>

                <p><a class="btn btn-default" href="/view?course=<?=$course['id']?>">Просмотр &raquo;</a></p>
            </div>
            <?php endforeach;?>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
