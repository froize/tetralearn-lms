<?php

$this->registerJsFile('js/take-report.js',
    [
        'depends' => [\app\assets\AppAsset::className()],
        'position' => yii\web\View::POS_END
    ]);

?>

<?php if ($taken) : ?>
    <span class="accepted">Доклад уже взят</span>
<? else: ?>
<span data-report-id="<?= $report['id'] ?>" class="accept">Взять доклад</span><? endif; ?>
