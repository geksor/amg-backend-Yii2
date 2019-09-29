<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Timetable */
/* @var $day */
/* @var $group */
/* @var $numberTraining */

$this->title = "Создание пункта расписания день $day группа $group";
$this->params['breadcrumbs'][] = ['label' => "Расписание на день $day группа № $group", 'url' => ['table', 'TimetableSearch' => ['weekday' => $day, 'group' => $group]]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="timetable-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'day' => $day,
        'group' => $group,
    ]) ?>

</div>
