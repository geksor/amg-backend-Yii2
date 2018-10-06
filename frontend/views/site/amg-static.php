<?php
/**
 * Created by PhpStorm.
 * User: Geksar
 * Date: 20.09.2018
 * Time: 11:29
 */

/* @var $this yii\web\View */
/* @var $questionModel \common\models\AmgStaticQuestion */

$this->title = 'MyNT2018 Amg статика';
?>

<div class="info">
    <?= $this->render('_top-line', [
        'title' => 'Amg статика',
        'link' => Yii::$app->homeUrl,
   ]) ?>
    <div class="x-class_content">
        <div class="amg_static_slick">

            <? $photoArr = $questionModel->getPhotos(); ?>


            <div>
                <div id="droppable_1" data-image="1" class="amg__questImage" style = 'background-image: url(<?= $photoArr['thumb_image_1'] ?>)'></div>
            </div>

            <div>
                <div id="droppable_2" data-image="2" class="amg__questImage" style = 'background-image: url(<?= $photoArr['thumb_image_2'] ?>)'></div>
            </div>

            <div>
                <div id="droppable_3" data-image="3" class="amg__questImage" style = 'background-image: url(<?= $photoArr['thumb_image_3'] ?>)'></div>
            </div>

        </div>
        <div class = "dotsAppend"></div>

        <div id="lobby" class = "mix_amg">
            <? foreach ($questionModel->amgStaticAnswers as $key => $answer) {?>
                <div class="amg__answer color_<?= $key ?>" data-set_color="color_<?= $key ?>" data-answer_id="<?= $answer->id ?>"><?= $answer->title ?></div>
            <?}?>
        </div>
    </div>
    <?= \yii\helpers\Html::tag('p', 'Ответить',
        ['class' => 'submit mix__noStars', 'id' => 'amg_static_answer']) ?>

    <?= \yii\helpers\Html::a('Далее',
        [
            '/site/amg-static',

        ],
        ['class' => 'submit mix__noStars', 'id' => 'amg_static_link']) ?>

    <?= $this->render('_footer') ?>
</div>
<script>
    window.onload = function () {

        var $lobbi = $('#lobby');
        var questId = <?= $questionModel->id ? $questionModel->id : 0 ?>;

        var inAnswer = function ($item, $drop) {
            $item
                .detach()
                .addClass('answerAppend')
                .appendTo($drop)
        };

        $("div", $lobbi).draggable({
            revert: "invalid"
        });

        $("#droppable_1,#droppable_2,#droppable_3").droppable({
            accept: "#lobby > div",
            drop: function(event, ui) {
                if (!$(this).hasClass('answerSet')){

                    $(this).removeClass('color_0 color_1 color_2').addClass(ui.draggable.data('set_color'));
                    $(this).attr('data-answer_id', ui.draggable.data('answer_id'));
                    $(this).addClass('answerSet');
                    $(this).droppable({
                        accept: '#nosinc'
                    });

                    inAnswer(ui.draggable, $(this));

                    if (!$('#lobby').find('div').hasClass('amg__answer')){
                        $('#amg_static_answer').removeClass('mix__noStars');
                    }
                }
            }
        });


        $('.amg_static_slick').slick(
            {
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: false,
                dots: true,
                arrows: false,
                appendDots: $('.dotsAppend'),
                dotsClass: 'mix_ul amg'

            }
        );


        $('#amg_static_link').on('click', function () {
            if ($(this).hasClass('mix__noStars')){
                return false;
            }
        });

        $('#amg_static_answer').on('click', function () {
            if ($(this).hasClass('mix__noStars')){
                return false;
            }

            var dataImg = '';

            $('.amg__questImage').each(function () {
                dataImg += '"img_' + $(this).data('image') + '":' + $(this).data('answer_id') + ',';
            });

            var setData = '{"questId":' + questId + ',' + dataImg + '"end":1}';

            $.ajax({
                url: '/site/amg-static',
                type: 'POST',
                data: JSON.parse(setData),
                dataType: 'json',
                success: function(data){
                    console.log(data);
                    if (data.img_1 === true){
                        $('#droppable_1').css('border-color', 'green')
                    }else {
                        $('#droppable_1').css('border-color', 'red')
                    }
                    if (data.img_2 === true){
                        $('#droppable_2').css('border-color', 'green')
                    }else {
                        $('#droppable_2').css('border-color', 'red')
                    }
                    if (data.img_3 === true){
                        $('#droppable_3').css('border-color', 'green')
                    }else {
                        $('#droppable_3').css('border-color', 'red')
                    }

                    $('#amg_static_answer').addClass('mix__noStars').hide();
                    $('#amg_static_link').removeClass('mix__noStars').show();
                }
            })

        });

    }
</script>


