$( function() {
    //siteIndex
    $('.progressBar').each(function () {

        $(this).progressbar({
            value: $(this).data('value'),
            max: $(this).data('max')
        })
    });

    //timetablePage
    $('.tabLink').on('click', function (event) {
        event.preventDefault();
        $('.tabLink').removeClass('active');
        $(this).addClass('active');
        $('.timetableDayWrap').removeClass('active');
        $('#'+$(this).attr('href')).addClass('active');

    });

    // mixStaticPage
    $(document).ready(function () {
        $('#w1').on('change', function () {
            $('.mix__noStars').removeClass('mix__noStars');
        })
    });
    
    $('#mix_static_link').on('click', function () {
        if ($(this).hasClass('mix__noStars')){
            return false;
        }
        var starCount = $('.rating-stars').attr('title');
        var href = $(this).attr('href');
        href += '&stars='+starCount;
        $(this).attr('href', href);
    });
    $('.mix__link.viewed').on('click', function (event) {
        event.preventDefault();
    });

    // popup points
    $('#pointsOk').on('click', function () {
        $('.popupWrap').hide();
    });


    // amgStaticPage
    var $lobbi = $('#lobby');

    function inAnswer ($item, $drop) {
        $item
            .detach()
            .addClass('answerAppend')
            .appendTo($drop)
    }

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
                    $('.mix__noStars').removeClass('mix__noStars');
                }
            }
        }
    });


    $(document).ready(function () {
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
    });

    $('#amg_static_link').on('click', function () {
        if ($(this).hasClass('mix__noStars')){
            return false;
        }

        var href = $(this).attr('href');

        $('.amg__questImage').each(function () {
            href += '&img_' + $(this).data('image') + '=' + $(this).data('answer_id');
        });

        $(this).attr('href', href);
    });


    $('#personalDataOpen').on('click', function () {
        $('.personal_data').show('fade', 300);
    });
    $('#personalDataClose').on('click', function () {
        $('.personal_data').hide('fade', 300);
    });
} );
