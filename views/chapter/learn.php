<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Chapter */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Главы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="page-lecture-view">
    <div class="container">
        <div class="row">
            <div class="col-md-12 lecture-content">
                <div class="lecture-content-wrapper dfx-format-text">
                    <?php foreach ($chapter['lectures'] as $lecture) :?>
                    <br/>
                    <h2><?= Html::a($lecture['name'], ['/lecture/view', 'id' => $lecture['id']]) ?></h2>
                    <?=$lecture['text']?>
                        <?php if ($lecture['file'] != ''):?>
                        <div class="lecture-doc-wrapper" style="padding:0 0 60px 0;box-shadow:none;height: initial;">
                            <!--<div class="icon-container">-->
                            <!--<i class="fal fa-presentation"></i>-->
                            <!--</div>-->
                            <div class="doc-content">
                                <h4 class="dfx-title-sm">Файл лекции</h4>
                                <div class="doc-list">
                                    <div class="item">
                                        <div class="icon-container">
                                            <i class="fal fa-file"></i>
                                        </div>
                                        <div>
                                            <h5 class="name"><?=$lecture['file']?></h5>
                                            <div class="action">
                                                <span style="color: #4fd065;text-decoration: underline;"><a href="/uploads/<?=$lecture['file']?>">Скачать</a></span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif;?>
                    <?php endforeach;?>
                </div>
            </div>
            <?php foreach ($chapter['tasks'] as $task) :?>
            <div class="col-md-12 lecture-task">
                <div class="lecture-task-wrapper">
                    <div class="icon-container">
                        <i class="fal fa-tasks"></i>
                    </div>
                    <div class="task-content">
                        <h4 class="dfx-title-sm">Практическое задание</h4>
                        <p class="jjj"><?=$task['name']?></p>
                        <div class="dfx-btn-grp">
                            <?= Html::a('<i class="fa fa-file-word"></i>Скачать
                                        документ', ['/uploads/'. $task['file']], ['class' => 'dfx-btn dfx-btn-success']) ?>
                            <?= Html::a('Перейти к заданию', ['/task/view', 'id' => $task['id']], ['class'=> 'dfx-btn-scnd']) ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
            <?php if($reports != array()):?>
                <div class="col-md-12 lecture-doc">
                    <div class="lecture-doc-wrapper">
                        <!--<div class="icon-container">-->
                        <!--<i class="fal fa-presentation"></i>-->
                        <!--</div>-->
                        <div class="doc-content">
                            <h4 class="dfx-title-sm">Доклады по курсу</h4>
                            <div class="doc-list">
                                <?php foreach ($reports as $report) :?>
                                    <div class="item">
                                        <div class="icon-container">
                                            <i class="fal fa-file"></i>
                                        </div>
                                        <div>
                                            <h5 class="name"><?=$report['title']?></h5>
                                            <div class="action">
                                                <?php if ($report['userReports'] != array()): ?>
                                                    <?php foreach ($report['userReports'] as $userReport) : ?>
                                                        <?php if ($userReport['report_id'] == $report['id']) : ?>
                                                            <?= $this->render('_report', [
                                                                'report' => $report,
                                                                'taken' => true,

                                                            ]) ?>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                <?php else:?>
                                                    <?= $this->render('_report', [
                                                        'report' => $report,
                                                        'taken' => false,

                                                    ]) ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                    </div>
                                <?php endforeach;?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif;?>
        </div>
    </div>
</div>

