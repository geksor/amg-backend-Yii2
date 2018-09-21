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

    $( "#draggable, #draggable_1, #draggable_2" ).draggable();

    $( "#droppable" ).droppable({
        drop: function( event, ui ) {
            $( this )
                .addClass( "ui-state-highlight" )
                .find( "p" )
                .html( "Dropped!" );
        }
    });

    $( "#draggable_x, #draggable_x_1, #draggable_x_2" ).draggable();
    $( "#droppable_x" ).droppable({
        drop: function( event, ui ) {
            $( this )
                .addClass( "ui-state-highlight-x" )
                .find( "p" )
                .html( "Dropped!" );
        }
    });
    $( "#draggable_x, #draggable_x_1, #draggable_x_2" ).draggable();
    $( "#droppable_x_2" ).droppable({
        drop: function( event, ui ) {
            $( this )
                .addClass( "ui-state-highlight-x" )
                .find( "p" )
                .html( "Dropped!" );
        }
    });

    $('#personalDataOpen').on('click', function () {
        $('.personal_data').show('fade', 300);
    });
    $('#personalDataClose').on('click', function () {
        $('.personal_data').hide('fade', 300);
    });
} );
