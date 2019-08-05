<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Task */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$script = "
$('#upload-answer').click(function () {
    $('#uploadfile-file').click();
    $('#uploadedTask').on('change', function () {
          $('#submitTask').click();
        });
    
});       
";
$this->registerJs($script);
?>
<div class="page-tasks">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="tasks-container">
                    <?php if ($assessment == array()): ?>
                        <?php if ($model->with_deadline): ?>
                            <div class="item">
                                <div class="icon-container">
                                    <i class="fal fa-file"></i>
                                </div>
                                <div class="content">
                                    <span class="course-name"><?= $course['name'] ?></span>
                                    <h3 class="name dfx-title-sm"><?= $model->name ?></h3>
                                    <p class="desc"><?= $model->text ?></p>
                                    <div class="meta">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped bg-info progress-bar-animated"
                                                 role="progressbar"
                                                 aria-valuenow="<?php echo(((int)strtotime('now') - (int)strtotime($model->start_date)) / ((int)strtotime($model->end_date) - (int)strtotime($model->start_date))) ?>"
                                                 aria-valuemin="0"
                                                 aria-valuemax="100"
                                                 style="width: <?php echo (((int)strtotime('now') - (int)strtotime($model->start_date)) / ((int)strtotime($model->end_date) - (int)strtotime($model->start_date))) * 100 ?>%"></div>
                                        </div>
                                        <span class="date">Осталось <?php echo \app\models\Task::timeToStart($model->end_date); ?></span>
                                    </div>
                                    <div class="dfx-btn-grp action-container">
                                        <a href="#" class="dfx-btn dfx-btn-success" id="upload-answer"><i
                                                    class="fal fa-upload"></i>Загрузить
                                            ответ</a>
                                        <?php $form = ActiveForm::begin([
                                            'id' => 'uploadingTask',
//                                            'options' => [
//                                                'enctype' => 'multipart/form-data'
//                                            ],
                                        ]); ?>
                                        <?php Html::input('hidden', 'idmodel', $model->id, ['id' => 'idmodel']) ?>
                                        <div style="display: none">
                                            <?= $form->field($uploaded_file, 'file', [
                                                'options' => [
                                                    'id' => 'uploadedTask'
                                                ],
                                            ])->fileInput()->label('') ?>

                                            <?= Html::submitButton('Загрузить ответ', [
                                                'class' => 'dfx-btn dfx-btn-success',
                                                'id' => 'submitTask',
                                                'type' => 'hidden'
                                            ]) ?>

                                        </div>
                                        <?php ActiveForm::end(); ?>
                                        <?= Html::a('Скачать задание', ['/uploads/' . $model->file], ['class' => 'dfx-btn-scnd']) ?>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="item">
                                <div class="icon-container">
                                    <i class="fal fa-file"></i>
                                </div>
                                <div class="content">
                                    <span class="course-name"><?= $course['name'] ?></span>
                                    <h3 class="name dfx-title-sm"><?= $model->name ?></h3>
                                    <p class="desc"><?= $model->text ?></p>
                                    <div class="meta">
                                        <span class="date">У задания не установлен срок сдачи</span>
                                    </div>
                                    <div class="dfx-btn-grp action-container">
                                        <a href="#" class="dfx-btn dfx-btn-success" id="upload-answer"><i
                                                    class="fal fa-upload"></i>Загрузить
                                            ответ</a>
                                        <?php $form = ActiveForm::begin([
                                            'id' => 'uploadingTask',
//                                            'options' => [
//                                                'enctype' => 'multipart/form-data'
//                                            ],
                                        ]); ?>
                                        <?php Html::input('hidden', 'idmodel', $model->id, ['id' => 'idmodel']) ?>
                                        <div style="display: none">
                                            <?= $form->field($uploaded_file, 'file', [
                                                'options' => [
                                                    'id' => 'uploadedTask'
                                                ],
                                            ])->fileInput()->label('') ?>

                                            <?= Html::submitButton('Загрузить ответ', [
                                                'class' => 'dfx-btn dfx-btn-success',
                                                'id' => 'submitTask',
                                                'type' => 'hidden'
                                            ]) ?>

                                        </div>
                                        <?php ActiveForm::end(); ?>
                                        <?= Html::a('Скачать задание', ['/uploads/' . $model->file], ['class' => 'dfx-btn-scnd']) ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <?php if ($assessment['grade'] == ''): ?>
                            <div class="item">
                                <div class="icon-container">
                                    <i class="fal fa-file"></i>
                                    <div class="mark process">
                                        <i class="fa fa-check"></i>
                                    </div>
                                </div>
                                <div class="content">
                                    <span class="course-name"><?= $course['name'] ?></span>
                                    <h3 class="name dfx-title-sm"><?= $model->name ?></h3>
                                    <p class="desc"><?= $model->text ?></p>
                                    <div class="meta">
                                        <span class="date">Отправлено на проверку <?= $assessment['date'] ?></span>
                                    </div>
                                    <div class="dfx-btn-grp action-container">
                                        <a href="" class="dfx-btn dfx-btn-success dfx-btn-inactive"><i
                                                    class="fal fa-eye"></i>На проверке</a>
                                        <?= Html::a('Скачать задание', ['/uploads/' . $model->file], ['class' => 'dfx-btn-scnd']) ?>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>

                            <div class="item">
                                <div class="icon-container">
                                    <i class="fal fa-file"></i>
                                    <div class="mark finished">
                                        <i class="fa fa-check"></i>
                                    </div>
                                </div>
                                <div class="content">
                                    <span class="course-name"><?= $course['name'] ?></span>
                                    <h3 class="name dfx-title-sm"><?= $model->name ?></h3>
                                    <p class="desc"><?= $model->text ?></p>
                                    <div class="assessment">
                                        <span class="assessment-desc">Ваша оценка: </span>
                                        <span class="value"><i><?= $assessment['grade'] ?></i>/<i><?= $model->max_points ?></i></span>
                                    </div>
                                    <div class="dfx-btn-grp action-container">
                                        <a href="" class="dfx-btn dfx-btn-success dfx-btn-inactive"><i
                                                    class="fal fa-check-circle"></i>Задание оценено</a>
                                        <?= Html::a('Скачать задание', ['/uploads/' . $model->file], ['class' => 'dfx-btn-scnd']) ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>