var serverStart = function () {
    $.ajax({
        type: 'GET',
        url: 'run',

        success: function (data) {
            console.log(data);
        },
        error: function (data) {
            console.log(data);
        }
    })
};


var connect = function () {
    var socket = new WebSocket('ws://localhost:' + $('.modelWrap').data('port'));
    socket.onopen = function () {
        console.log('Connected');
    };
    socket.onerror = function (ev) {
      serverStart();
    };
    socket.onmessage = function (e) {
        var response = JSON.parse(e.data);
        var model = JSON.parse(response.message);
        console.log(model);
        $('.modelWrap').append('<p id="item_'+ model.id +'">' + model.title + '</p>');
    };

};

if ($('.modelWrap')){
    connect();
}

