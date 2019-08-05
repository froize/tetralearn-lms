<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;


$user = \app\models\User::find()
    ->asArray()
    ->where([
        'id' => Yii::$app->user->getId()
    ])
    ->one();
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">

    <head>

        <meta charset="<?= Yii::$app->charset ?>">
        <!-- <base href="/"> -->

        <?php $this->registerCsrfMetaTags() ?>
<!--        <title>--><?//=($this->params['header'])? (Html::encode($this->params['header'])) : ('')?><!----><?//=($this->params['description'])? (' - '. Html::encode($this->params['description'])) : ('')?><!--</title>-->
        <title><?= Html::encode($this->title) ?></title>
        <meta name="description" content="">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <!-- Template Basic Images Start -->
        <meta property="og:image" content="path/to/image.jpg">
        <link rel="apple-touch-icon" sizes="57x57" href="/img/favicon/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/img/favicon/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/img/favicon/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/img/favicon/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/img/favicon/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/img/favicon/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/img/favicon/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/img/favicon/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/img/favicon/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192" href="/img/favicon/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/img/favicon/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon/favicon-16x16.png">
        <link rel="manifest" href="/img/favicon/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">

        <!-- Chrome, Firefox OS and Opera -->
        <meta name="theme-color" content="#CE4944">
        <!-- Windows Phone -->
        <meta name="msapplication-navbutton-color" content="#CE4944">
        <!-- iOS Safari -->
        <meta name="apple-mobile-web-app-status-bar-style" content="#CE4944">
        <!-- Template Basic Images End -->

        <?php $this->head() ?>
    </head>

    <body>
    <?php $this->beginBody() ?>
    <!--Прелоадер-->
    <div id="page-preloader">
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>
    <!--/Прелоадер-->

    <main id="page" class="panel">
        <header>
            <div class="container">
                <div class="header-wrapper">
                    <div class="logo-container">
                        <a href="/"> <img src="/img/logo.svg" class="dfx-img-rsp"/></a>
                    </div>
                    <div class="menu">
                        <ul>
                            <?php if (!Yii::$app->user->isGuest): ?>
                                <?php if ($user['is_tutor']): ?>
                                    <li><a href="/admin/course/">Курсы</a></li>
                                    <!--                        <li><a href="/admin/chat/">Чат</a></li>-->
                                    <li><a href="/admin/invitation/">Заявки</a></li>
                                    <li><a href="/admin/report/">Доклады</a></li>
                                    <li><a href="/admin/grade/">Оценки</a></li>
                                    <li><a href="/admin/group/">Группы</a></li>
                                <?php else:; ?>
                                    <li><a href="/course/">Активные курсы</a></li>
                                    <!--                        <li><a href="/chat/">Чат</a></li>-->
                                    <li><a href="/invitation/">Заявки</a></li>
                                    <li><a href="/report/">Доклады</a></li>
                                    <li><a href="/grade/">Оценки</a></li>
                                <?php endif; ?>
                            <?php endif; ?>

                        </ul>
                        <div class="user-info">
                            <div class="photo">
                                <span class="notification"></span>
                                <?php if (!Yii::$app->user->isGuest && $user['avatar'] != '') : ?>
                                    <img src="/uploads/<?= $user['avatar'] ?>" class="dfx-img-rsp"/>
                                <? else: ?>
                                    <img src="/img/photo.jpg" class="dfx-img-rsp"/><? endif; ?>
                            </div>
                            <div class="info">
                            <span class="name">
                                <?php if (Yii::$app->user->isGuest): ?>
                                    Гость
                                <?php else: ?>
                                    <?php if ($user['is_tutor']): ?>
                                        <?= Html::a($user['name'], ['/admin/user/view', 'id' => $user['id']]) ?>
                                    <?php else: ?>
                                        <?= Html::a($user['name'], ['/user/view', 'id' => $user['id']]) ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </span>
                                <?php echo Yii::$app->user->isGuest ?
                                    ('<a href="/login" class="to-account">Вход</a>')
                                    : ('<a href="/logout" class="to-account">Выход</a>') ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <section id="page-info">
            <div class="container">
                <h1 class="dfx-title"><?= Html::encode($this->params['header']) ?></h1>
                <p class="desc"><?= Html::encode($this->params['description']) ?></p>
            </div>
        </section>
        <section id="page-content">
            <?= $content ?>
        </section>
        <footer>

        </footer>
    </main>


    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>