<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model \common\models\VideoUpload */
/* @var $form yii\widgets\ActiveForm */
/* @var $message */
/* @var $id */
?>
<style>
    .ui-progressbar {
        position: relative;
    }
    .progress-label {
        position: absolute;
        left: 50%;
        top: 4px;
        font-weight: bold;
        text-shadow: 1px 1px 0 #fff;
    }
    .ui-progressbar-value{
        margin: 0!important;
    }
</style>
<div class="set-video-form">
    <?php Pjax::begin(); ?>
        <div id="progressbar" class="ui-progressbar" style="display: none"><div class="progress-label">Loading...</div></div>

    <?php $form = ActiveForm::begin([
            'action' => '/admin/photo-report/save-video/'.$id,
            'options' => [
                'enctype'=>'multipart/form-data',
                'data-pjax' => '',
                'class' => 'ajaxForm',
            ],
        ]); ?>

        <?= $form->field($model, 'video')->fileInput() ?>

        <?= $form->field($model, 'title')->textInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

        <div id="popUp" class="modal fade">
            <div class="modal-dialog">
                    <?php
                    \yiister\adminlte\widgets\Box::begin(
                        [
                            "header" => $message ? $message : '',
                            "type" => \yiister\adminlte\widgets\Box::TYPE_PRIMARY,
                            "filled" => true,
                        ]
                    )
                    ?>
                    <p style="text-align: center"><?= Html::a('OK', ['photo-report/view', 'id' => $id], ['class' => 'btn btn-primary']) ?></p>
                    <?php \yiister\adminlte\widgets\Box::end() ?>
            </div>
        </div>
    <script>
            var modal = <?= $message ? "'$message'" : 0 ?>;
            if (modal !== 0){
                $("#popUp").modal('show');
            }
    </script>

    <?php Pjax::end(); ?>


</div>



<script>
    window.onload = function (ev) {
        var progressbar = $( "#progressbar" ),
            progressLabel = $( ".progress-label" );

        progressbar.progressbar({
            value: false,
            complete: function() {
                progressLabel.text( "Complete!" );
            }
        });

        $('.ajaxForm').on('submit', function () {
            progressbar.show();
        });

    }
</script>
