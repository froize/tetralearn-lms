<?php

use yii\helpers\Html;
use app\assets\LoginAsset;

LoginAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

<!--    <meta property="og:image" content="path/to/image.jpg">-->
    <link rel="shortcut icon" href="/img/favicon/favicon.ico" type="image/x-icon">

    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#a755e5">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#a755e5">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#a755e5">

    <meta property="og:image" content="http://tetrabet.com/img/opengraph/main.png">

    <meta charset="UTF-8">
    <title>Авторизация</title>
    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>

</head>
<body>
<?php $this->beginBody() ?>

<!--Прелоадер-->
<div id="page-preloader">
    <div class="loader"></div>
</div>
<!--/Прелоадер-->

<div class="limiter">
    <?= $content ?>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>