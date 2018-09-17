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
    var socket = new WebSocket('ws://localhost');
    socket.onopen = function (response) {
        console.log(response);
    };
    socket.onerror = function (response) {
      console.log(response);
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

