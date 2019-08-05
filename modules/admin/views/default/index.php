<?php

use yii\helpers\Html;
use yii\grid\GridView;
$this->title = 'Панель администрирования';
$this->params['header'] = 'Панель администрирования';
$this->params['description'] = 'Быстрый доступ к редактированию всех модулей';

?>

<?php if ($user['is_tutor']) : ?>
    <?php foreach ($own_courses as $own_course) : ?>
        <div class="item col-sm-4">
            <div class="item-wrapper">
                <div class="img-container">
                    <div class="category">
                        <?php if ($own_course['is_private']): ?>
                            <span class="private"><i class="far fa-lock"></i></span>
                        <?php endif; ?>
                        <span class="name" style="background:#19b5fe;">Программирование</span>
                    </div>
                    <?php if ($own_course['pic'] != '') : ?><img src="/uploads/<?= $own_course['pic'] ?>"
                                                                 class="dfx-img-rsp"/><? else: ?>
                        <img src="/img/course-1.jpg" class="dfx-img-rsp"/><? endif; ?>
                </div>
                <div class="course-info">
                    <h2 class="dfx-title"><?= Html::a($own_course['name'], ['course/view', 'id' => $own_course['id']], ['class' => 'btn btn-primary']) ?></h2>
                    <div class="course-desc dfx-text"><?php echo \yii\helpers\StringHelper::truncate($own_course['description'], 150, '...'); ?></div>
                    <div class="author-info">
                        <div class="photo">
                            <img src="<?php echo ($own_course['tutor']['avatar'] != '') ? ("/uploads/" . $own_course['tutor']['avatar']) : ("/img/photo.jpg") ?>"
                                 class="dfx-img-rsp"/>
                        </div>
                        <div class="info">
                            <span class="name"><?= $own_course['tutor']['name'] . ' ' . $own_course['tutor']['surname'] ?></span>
                            <span class="specialization"><?= $own_course['tutor']['spec'] ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>