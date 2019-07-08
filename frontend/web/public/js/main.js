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
        $('#insertText').text($('#help_' + nextSlide).text());
        if ($('.mbux_slick').slick('getSlick').slideCount === ++nextSlide){
            $('.button_next.mbux__next').hide();
            $('.button_next.mbux__end').show();
        }
    });

        $('.mbux__helpShow').on('click', function (e) {
            e.preventDefault;
            $('.mbux__help').show('fade', 300);
        });

        $('.mbux__helpHide').on('click', function (e) {
            e.preventDefault;
            $('.mbux__help').hide('fade', 300);
        });


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
    
    $('#checkBoxAgree').on('change', function () {
        if ($(this).prop('checked')){
            $('#registerLink').show();
        } else {
            $('#registerLink').hide();
        }
    });

    //xClass
    var colLeft = null;
    var colRight = null;
    var end;


    $( "#sortable_left, #sortable_0, #sortable_right" ).sortable({
        connectWith: ".connectedSortable",
        items: "img",
        receive: function( event, ui ) {
            if ($(this).hasClass('full')){
                ui.sender.sortable("cancel");
                return false;
            }
            switch ($(this).data('column')) {
                case 0:
                    colRight = ui.item.data('image_id');
                    if (ui.item.hasClass('imageLeft')){
                        ui.item.removeClass('imageLeft');
                        ui.sender.removeClass('full');
                        if (colLeft === ui.item.data('image_id')) {
                            colLeft = null;
                        }
                    }
                    ui.item.addClass('imageRight');
                    $(this).addClass('full');
                    break;
                case 1:
                    colLeft = ui.item.data('image_id');
                    if (ui.item.hasClass('imageRight')){
                        ui.item.removeClass('imageRight');
                        ui.sender.removeClass('full');
                        if (colRight === ui.item.data('image_id')) {
                            colRight = null;
                        }
                    }
                    ui.item.addClass('imageLeft');
                    $(this).addClass('full');
                    break;
                case 2:
                    end = false;
                    if (colRight === ui.item.data('image_id')){
                        colRight = null;
                        $('#sortable_right').removeClass('full');
                    }
                    if (colLeft === ui.item.data('image_id')){
                        colLeft = null;
                        $('#sortable_left').removeClass('full');
                    }
                    ui.item.removeClass('imageRight').removeClass('imageLeft');
            }
            if (colLeft && colRight){
                var questId = $('#xclassSubmit').data('quest_id');

                $('#xclassSubmit')
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
        var setData = $(this).data('params');

        $.ajax({
            url: '/site/x-class-line',
            type: 'POST',
            data: setData,
            dataType: 'json',
            success: function(data){
                if (data.colLeft === true){
                    $('.imageLeft').css('border', 'solid 4px #42b51a');
                }else {
                    $('.imageLeft').css('border', 'solid 4px #ff2020');
                }
                if (data.colRight === true){
                    $('.imageRight').css('border', 'solid 4px #42b51a');
                }else {
                    $('.imageRight').css('border', 'solid 4px #ff2020');
                }

                $('#xclassSubmit').hide();
                $('#xclassNext').show();
            }
        })
    });

    //quizPage
    $('.quiz__answer').on('click', function () {
        $('.quiz__answer').removeClass('active');
        $(this).addClass('active');
    })
} );
