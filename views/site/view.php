<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Course */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Курсы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="course-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if($author['id'] == Yii::$app->user->getId()) echo Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php if($author['id'] == Yii::$app->user->getId()) echo Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот курс?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <table id="w0" class="table table-striped table-bordered detail-view"><tbody><tr><th>Название курса</th><td><?=$model->name?></td></tr>
        <tr><th>Автор</th><td><?=$author['name'].' '.$author['surname']?></td></tr>
        <tr><th>Рейтинг</th><td><?=$model->rating?></td></tr>
        <tr><th>Дата запуска</th><td><?=$model->start_date?></td></tr>
        <tr><th>Дата окончания</th><td><?=$model->end_date?></td></tr>
        <tr><th>Курс активен</th><td><?=($model->active ? 'Да' : 'Нет'); ?></td></tr>
        <tr><th>Приватный</th><td><?=($model->is_private ? 'Да' : 'Нет')?></td></tr>
        <tr><th>Группы</th><td><?php foreach ($group_participant as $gp) echo $gp['name'].'<br/>'; ?></td></tr>
        <tr><th>Участники</th><td><?php foreach ($user_participant as $up) echo $up['name'].' '. $up['surname'].'<br/>'; ?></td></tr></tbody></table>

    <!--    --><?//= DetailView::widget([
    //        'model' => $model,
    //        'attributes' => [
    //            'id',
    //            'name',
    //            'desc:ntext',
    //            'rating',
    //            'start_date',
    //            'end_date',
    //            'active',
    //            'tutor_id',
    //            'is_private',
    //        ],
    //    ]) ?>
    <?php echo '<h2>Описание курса</h2><p>'.$model->desc.'</p>'?>
    <?php if($author['id'] == Yii::$app->user->getId()) echo Html::a('Создать главу', ['chapter/create', 'course_id' => $model->id], ['class' => 'btn btn-lg btn-success']);?>
    <?php for($i = 0;$i<count($chapters);$i++) {
        echo '<h2>Глава '. ($i+1). ': '.$chapters[$i]['name']. '</h2>';
        if($author['id'] == Yii::$app->user->getId()) echo Html::a('Изменить главу', ['chapter/update', 'id' => $chapters[$i]['id']], ['class' => 'btn btn-success']).'<br/>';
        if($author['id'] == Yii::$app->user->getId()) echo Html::a('Создать лекцию', ['lecture/create', 'chapter_id' => $chapters[$i]['id']], ['class' => 'btn btn-primary']);
        foreach($lectures[$i] as $lecture) {

            echo '<br/><b>'.$lecture['name']. '</b><br/>';
            echo $lecture['text']. '<br/>';
            if($lecture['file']) echo '<p><a href="/upload/'. $lecture['file'] .'">'.'Файл лекции: '.$lecture['file']. '</a></p>';
            if($author['id'] == Yii::$app->user->getId()) echo Html::a('Изменить лекцию', ['lecture/update', 'id' => $lecture['id']], ['class' => 'btn btn-primary']);
            if($author['id'] == Yii::$app->user->getId()) echo Html::a('Удалить лекцию', ['lecture/delete', 'id' => $lecture['id']], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Вы уверены, что хотите удалить эту лекцию?',
                    'method' => 'post',
                ],
            ]);
        }

    }

    ?>
</div>
