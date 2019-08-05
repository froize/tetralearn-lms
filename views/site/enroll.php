<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\Course */

$this->title = 'Запись на курс';
$this->params['breadcrumbs'][] = ['label' => 'Курсы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="enroll-create">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'course_id')->textInput()->label('ID Курса') ?>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
