<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Chapter */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Chapters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="page-course-learn">
    <div class="container">
        <div class="chapters-container">
            <div class="row">
                <?php $i = 1; ?>
                <?php foreach ($course['chapters'] as $chapter) : ?>
                    <div class="col-md-12 item">
                        <a href="<?= \yii\helpers\Url::to(['/chapter/learn', 'id' => $chapter['id']]) ?>">
                            <div class="wrapper">
                                <div class="icon-container">
                                    <span class="num"><?= $i ?></span>
                                    <span class="desc">глава</span>
                                </div>
                                <div class="content">
                                    <h3 class="name dfx-title-sm"><?= $chapter['name'] ?></h3>
                                    <div class="meta">
                                        <?php if (count($chapter['lectures'][0]) > 0): ?>
                                            <span class="meta-item">Лекция</span>
                                        <? endif; ?>
                                        <?php if (count($chapter['tasks'][0]) > 0): ?>
                                            <span class="meta-item">Практическое задание</span>
                                        <? endif; ?>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php $i++; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>