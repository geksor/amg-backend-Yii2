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

    //mbux
    $(document).ready(function () {
        $('.mbux_slick').slick(
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
        $('.button_next').on('click', function () {
            $('.mbux_slick').slick('slickNext');
        });

    });

    $('.mbux_slick').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
        $('.mbux__helpHide').trigger('click');
        if ($('.mbux_slick').slick('getSlick').slideCount === ++nextSlide){
            $('.button_next.mbux__next').hide();
            $('.button_next.mbux__end').show();
        }
    });

    function showOn(){
        $('.mbux__helpShow').on('click', function (e) {
            e.preventDefault;
            $('.mbux__help').show('fade', 300);
            $(this).text('Скрыть подсказку').addClass('mbux__helpHide', function () {
                $(this).removeClass('mbux__helpShow');
                $(this).unbind('click');
                showOff();
            });
        });
    }

    function showOff(){
        $('.mbux__helpHide').on('click', function (e) {
            e.preventDefault;
            $('.mbux__help').hide('fade', 300);
            $(this).text('Подсказка').addClass('mbux__helpShow', function () {
                $(this).removeClass('mbux__helpHide');
                $(this).unbind('click');
                showOn()
            });
        });
    }

    showOn();

    //amgDrive end mixDrive
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#insertImage').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    $('.jsImageInput').on('change', function () {
        readURL(this);
    });

    //login
    $('#personalDataOpen').on('click', function () {
        $('.personal_data').show('fade', 300);
    });
    $('#personalDataClose').on('click', function () {
        $('.personal_data').hide('fade', 300);
    });

    //xClass
    var colLeft = null;
    var colRight = null;

    $( "#sortable_left, #sortable_0, #sortable_right" ).sortable({
        connectWith: ".connectedSortable",
        items: "img",
        receive: function( event, ui ) {
            switch ($(this).data('column')) {
                case 0:
                    colRight = ui.item.data('image_id');
                    break;
                case 1:
                    colLeft = ui.item.data('image_id');
                    break;
                case 2:
                    end = false;
                    if (colRight === ui.item.data('image_id')){
                        colRight = null;
                    }
                    if (colLeft === ui.item.data('image_id')){
                        colLeft = null;
                    }
            }
            if (colLeft && colRight){
                var questId = $('#xclassSubmit').data('quest_id');

                $('#xclassSubmit')
                    .attr('data-method', 'POST')
                    .attr('data-params', '{ "questId":' + questId +',"colLeft":' + colLeft + ',"colRight":' + colRight + '}' )
                    .removeClass('mix__noStars');
            }else {
                if (!$('#xclassSubmit').hasClass('mix__noStars')){
                    $('#xclassSubmit').addClass('mix__noStars');
                }
            }
        }
    }).disableSelection();
    $('#xclassSubmit').on('click', function () {
        if ($(this).hasClass('mix__noStars')){
            return false;
        }
    })

} );
