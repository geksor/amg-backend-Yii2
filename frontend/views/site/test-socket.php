<?php

/* @var $this yii\web\View */
/* @var $model \common\models\DealerCenter */

$this->title = 'My Yii Application';
?>
<div class="site-test-socket">
    <? if ($model) {?>
        <div class="modelWrap" data-port="8081">
            <?foreach ($model as $item) {?>
                <p id="item_<?= $item->id ?>"><?= $item->title ?></p>
            <?}?>
        </div>
    <?}?>
</div>
