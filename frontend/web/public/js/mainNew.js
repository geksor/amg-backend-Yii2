
var connect = function () {
    var socket = new WebSocket('ws://188.225.10.52:1024');
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

// test-jinmedia.tw1.ru