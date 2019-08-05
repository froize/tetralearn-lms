<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->registerJsFile('js/enroll.js',
    [
        'depends' => [\app\assets\AppAsset::className()],
        'position' => yii\web\View::POS_END
    ]);

/* @var $this yii\web\View */
/* @var $model app\models\Course */

$this->title = 'Доступные курсы';
$this->params['breadcrumbs'][] = ['label' => 'Курсы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="page-course-view">
    <div class="container">
        <div class="row">
            <div class="col-md-8 course-info">
                <div class="course-info-wrapper">
                    <div class="course-header">
                        <h1 class="dfx-title-md name"><?= Html::encode($model->name) ?></h1>
                        <div class="meta">
                            <span class="item">Программирование</span>
                        </div>
                    </div>
                    <div class="img-container">
                        <img src="<?php echo ($model->pic != '') ? ('/uploads/' . $model->pic) : ('/img/course-1.jpg') ?>"
                             class="dfx-img-rsp"/>
                    </div>
                    <div class="dfx-format-text">
                        <?= $model->description ?>
                    </div>
                    <div class="table-of-contents">
                        <h3 class="dfx-title-md">Содержание курса</h3>
                        <div class="timeline">
                            <?php for ($i = 0; $i < count($course['chapters']); $i++): ?>
                                <div class="item">
                                    <h5 class="chapter">Глава <?= ($i + 1) ?></h5>
                                    <p class="name"><?= $course['chapters'][$i]['name'] ?></p>
                                    <div class="info">
                                        <?php if (count($course['chapters'][$i]['lectures']) > 0) : ?>
                                            <span>Лекция</span>
                                        <? endif ?>
                                        <?php if (count($course['chapters'][$i]['tasks']) > 0) : ?>
                                            <span>Практическое задание</span>
                                        <? endif ?>
                                    </div>
                                </div>
                            <?php endfor; ?>
                        </div>
                    </div>
                    <div class="about-author">
                        <h3 class="dfx-title-md">Об авторе курса</h3>
                        <div class="about-author-wrapper">
                            <div class="img-container">
                                <img src="<?php echo ($course['tutor']['avatar'] != '') ? ('/uploads/' . $course['tutor']['avatar']) : ('/img/photo.jpg') ?>"
                                     class="dfx-img-rsp"/>
                            </div>
                            <div class="info">
                                <span class="name"><?= $course['tutor']['name'] . ' ' . $course['tutor']['surname'] ?></span>
                                <span class="specialization"><?= $course['tutor']['spec'] ?></span>
                                <p class="biography">
                                    <?= $course['tutor']['description'] ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 course-action">
                <div class="course-action-wrapper sticky-top">
                    <h3 class="dfx-title-md">Записаться</h3>
                    <?php if (!Yii::$app->user->isGuest) : ?>
                        <?php if ($is_participant) : ?>
                            <p class="desc">Вы уже записаны на курс.</p>
                            <a href="" class="dfx-btn dfx-btn-success dfx-btn-inactive">Активный курс</a>
                            <?= Html::a('Перейти к курсу', ['course/learn', 'id' => $model->id], ['class' => 'go-to-course']) ?>

                        <?php else: ?>
                            <?php if ($invitation == array()) : ?>
                                <p class="desc">Нажмите на кнопку, чтобы запросить доступ к курсу у его владельца.</p>
                                <a href="" data-course-id="<?= $model->id ?>"
                                   class="request_access dfx-btn dfx-btn-success">Запросить доступ</a>
                            <?php else: ?>
                                <p class="desc">Вы уже отправили заявку на этот курс.</p>
                                <a href="" class="dfx-btn dfx-btn-success dfx-btn-inactive">Заявка отправлена</a>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php else: ?>
                        <p class="desc">Запись на курс доступна только после регистрации на сайте.</p>
                    <?php endif; ?>

                    <!--                    --><?php //if(!$model->is_private): ?>
                    <!--                    <p class="desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur est-->
                    <!--                        eveniet facilis nemo nesciunt.</p>-->
                    <!--                    <a href="" class="dfx-btn dfx-btn-success">Начать курс</a>-->
                    <!--                    --><?php //endif;?>
                </div>
            </div>
        </div>
    </div>
</div>
