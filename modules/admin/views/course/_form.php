<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Course */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-md-12 dfx-panel">
        <div class="dfx-panel-wrapper">

            <div class="panel-header">
                <h2 class="dfx-title-md">Курс</h2>
            </div>
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'description')->widget(\vova07\imperavi\Widget::className(), [
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

            <?= $form->field($model, 'start_date')->label('Дата начала')->widget(\yii\jui\DatePicker::class, [
                'language' => 'ru',
                'dateFormat' => 'yyyy-MM-dd',
            ]) ?>

            <?= $form->field($model, 'end_date')->label('Дата окончания')->widget(\yii\jui\DatePicker::class, [
                'language' => 'ru',
                'dateFormat' => 'yyyy-MM-dd',
            ]) ?>

            <?= $form->field($model, 'active')->checkbox() ?>

            <!--    --><? //= $form->field($model, 'tutor_id')->textInput() ?>

            <?= $form->field($model, 'is_private')->checkbox() ?>
            <?= $form->field($model, 'user_ids')
                ->dropDownList($participants_users, ['multiple' => true])->label('Участники') ?>
            <?= $form->field($model, 'group_ids')
                ->dropDownList($groups, ['multiple' => true])->label('Группы') ?>
<!--            --><?//= $form->field($model, 'curator_ids')
//                ->dropDownList($participants_users, ['multiple' => true])->label('Кураторы') ?>
            <?= $form->field($uploaded_file, 'file')->fileInput()->label('Изображение (для превью)') ?>

            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'dfx-btn dfx-btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>