<?php
namespace console\controllers;

use consik\yii2websocket\events\WSClientEvent;
use consik\yii2websocket\WebSocketServer;
use console\daemons\ChatServer;
use console\daemons\CommandsServer;
use console\daemons\EchoServer;
use console\daemons\TestServer;
use yii\console\Controller;

class ServerController extends Controller
{
    public function actionStart()
    {
        $ChatServer = new ChatServer();
        $ChatServer->port = 1024; //This port must be busy by WebServer and we handle an error
//        $ChatServer->port = 8081; //This port must be busy by WebServer and we handle an error

        $ChatServer->on(WebSocketServer::EVENT_WEBSOCKET_OPEN_ERROR, function($e) use($ChatServer) {
            echo "Error opening port " . $ChatServer->port . "\n";
            $ChatServer->port += 1; //Try next port to open
            $ChatServer->start();
        });

        $ChatServer->on(WebSocketServer::EVENT_WEBSOCKET_OPEN, function($e) use($ChatServer) {
            echo "Server started at port " . $ChatServer->port;
        });

        $ChatServer->on(WebSocketServer::EVENT_CLIENT_CONNECTED, function($e) use($ChatServer) {
            echo "\n Client Connect";
        });

        $ChatServer->on(WebSocketServer::EVENT_CLIENT_DISCONNECTED, function($e) use($ChatServer) {
            echo "\n Client Disconnect";
        });

        $ChatServer->start();

//        $testServer = new TestServer();
//        $testServer->port = 1024; //This port must be busy by WebServer and we handle an error
//
//        $testServer->on(WebSocketServer::EVENT_WEBSOCKET_OPEN_ERROR, function($e) use($testServer) {
//            echo "Error opening port " . $testServer->port . "\n";
//            $testServer->port += 1; //Try next port to open
//            $testServer->start();
//        });
//
//        $testServer->on(WebSocketServer::EVENT_WEBSOCKET_OPEN, function($e) use($testServer) {
//            echo "Server started at port " . $testServer->port;
//        });

//        $testServer->start();
    }
}