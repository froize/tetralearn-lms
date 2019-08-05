<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(); ?>
<?= $form->field($uploaded_file, 'file')->fileInput(['class' => 'dfx-btn dfx-btn-success'])->label('Загрузить ответ') ?>
<?php ActiveForm::end(); ?>
