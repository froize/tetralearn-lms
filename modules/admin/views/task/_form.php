<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;


/* @var $this yii\web\View */
/* @var $model app\models\Task */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-md-12 dfx-panel">
        <div class="dfx-panel-wrapper">

            <div class="panel-header">
                <h2 class="dfx-title-md">Задание</h2>
            </div>
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'active')->checkbox() ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'text')->widget(\vova07\imperavi\Widget::className(), [
                'settings' => [
                    'lang' => 'ru',
                    'minHeight' => 200,
                    'plugins' => [
                        'clips',
                        'fullscreen',
                    ],
                    'clips' => [
                        ['Lorem ipsum...', 'Lorem...'],
                        ['red', '<span class="label-red">red</span>'],
                        ['green', '<span class="label-green">green</span>'],
                        ['blue', '<span class="label-blue">blue</span>'],
                    ],
                ],
            ]);
            ?>


            <?= $form->field($model, 'with_deadline')->checkbox() ?>
            <?= $form->field($model, 'max_points')->textInput(['maxlength' => 2]) ?>

            <div class="form-group field-task-start_date">
                <label class="control-label" for="task-start_date">Дата начала</label>
                <?= DateTimePicker::widget([
                    'name' => 'Task[start_date]',
                    'id' => 'task-start_date',
                    'type' => DateTimePicker::TYPE_INPUT,
                    'value' => date('Y-m-d H:i'),
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd hh:ii'
                    ]
                ]);
                ?>

                <div class="help-block"></div>
            </div>
<!--            --><? //= $form->field($model, 'start_date')->label('Дата начала')->widget(\yii\jui\DatePicker::class, [
            //                'language' => 'ru',
            //                'dateFormat' => 'yyyy-MM-dd H:m',
            //            ]) ?>

            <div class="form-group field-task-end_date">
                <label class="control-label" for="task-end_date">Дата окончания</label>
                <?= DateTimePicker::widget([
                    'name' => 'Task[end_date]',
                    'id' => 'task-end_date',
                    'type' => DateTimePicker::TYPE_INPUT,
                    'value' => date('Y-m-d H:i'),
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd hh:ii'
                    ]
                ]);
                ?>


                <div class="help-block"></div>
            </div>
            <!--            --><? //= $form->field($model, 'end_date')->label('Дата окончания')->widget(\yii\jui\DatePicker::class, [
            //                'language' => 'ru',
            //                'dateFormat' => 'yyyy-MM-dd',
            //            ]) ?>

            <?= $form->field($uploaded_file, 'file')->fileInput()->label('Файл задания') ?>

            <?= $form->field($model, 'chapter_id')
                ->dropDownList($chapters)->label('Глава') ?>


            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'dfx-btn dfx-btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>