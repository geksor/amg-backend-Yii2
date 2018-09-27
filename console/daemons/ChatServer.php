<?php
namespace console\daemons;
use common\models\Chat;
use common\models\User;
use consik\yii2websocket\events\WSClientEvent;
use consik\yii2websocket\WebSocketServer;
use Ratchet\ConnectionInterface;

class ChatServer extends WebSocketServer
{

    public function init()
    {
        parent::init();

        $this->on(self::EVENT_CLIENT_CONNECTED, function(WSClientEvent $e) {
            $e->client->name = null;
            $e->client->id = null;
        });
    }


    protected function getCommand(ConnectionInterface $from, $msg)
    {
        $request = json_decode($msg, true);
        return !empty($request['action']) ? $request['action'] : parent::getCommand($from, $msg);
    }

    public function commandChat(ConnectionInterface $client, $msg)
    {
        $request = json_decode($msg, true);
        $result = ['message' => ''];

        if (!empty($request['message']) && $message = trim($request['message']) ) {

            //save from DB
            $userModel = User::findOne($client->id);
            $model = new Chat();
            $model->message = $message;
            $model->create_at = time();
            $model->user_id = $userModel->id;
            $model->training_id = $userModel->training_id;
            $model->save();
            //end Save from Db

            foreach ($this->clients as $chatClient) {
                $chatClient->send( json_encode([
                    'type' => 'chat',
                    'from' => [ 'name' => $client->name, 'id' => $client->id],
                    'message' => $message,
                ]) );
            }
        } else {
            $result['message'] = 'Введите сообщение';
        }

        $client->send( json_encode($result) );
    }

    public function commandSetName(ConnectionInterface $client, $msg)
    {
        $request = json_decode($msg, true);
        $result = ['message' => 'Username updated'];

        if (!empty($request['name']) && !empty($request['id']) && ($name = trim($request['name'])) && $id = trim($request['id'])) {
            $usernameFree = true;
            foreach ($this->clients as $chatClient) {
                if ($chatClient != $client && $chatClient->id == $id) {
                    $result['message'] = 'This id is used by other user';
                    $usernameFree = false;
                    break;
                }
            }

            if ($usernameFree) {
                $client->name = $name;
                $client->id = $id;
            }
        } else {
            $result['message'] = 'Invalid username';
        }

        $client->send( json_encode($result) );
    }

}