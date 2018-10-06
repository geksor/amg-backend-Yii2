<?php
/**
 * Created by PhpStorm.
 * User: Geksar
 * Date: 20.09.2018
 * Time: 11:29
 */

/* @var $this yii\web\View */
/* @var $questionModel \common\models\XClassLineQuestion */

$this->title = 'MyNT2018 X-Класс линии исполнения';
?>

<div class="info">
    <?= $this->render('_top-line', [
        'title' => 'X-Класс линии исполнения',
        'link' => Yii::$app->homeUrl,
   ]) ?>
    <div class="x-class_line">
        <div class="x-class_left connectedSortable" id="sortable_left" data-column="1">
            <p>Линия<br>Progressive</p>
        </div>
        <div id="sortable_0" class="x-class_center connectedSortable" data-column="2">
            <p>влево<br>вправо</p>

            <? foreach ($questionModel->xClassLineAnswers as $answer) {?>

                <img src = "<?= $answer->getPhotos()['thumb_image'] ?>" data-image_id="<?= $answer->id ?>" class = "mix_img xClassImage">

            <?}?>
        </div>
        <div class="x-class_right connectedSortable" id = "sortable_right" data-column="0">
            <p>Линия<br>Power</p>
        </div>
    </div>

    <span id="xclassSubmit" class="submit mix__noStars" data-quest_id="<?= $questionModel->id ?>">Ответить</span>

    <a id="xclassNext" href="/site/x-class-line" class="submit" style="display: none; margin-bottom: 60px">Далее</a>


    <?= $this->render('_footer') ?>
</div>


