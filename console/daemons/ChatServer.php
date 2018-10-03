<?php
namespace console\daemons;
use common\models\Chat;
use common\models\Command;
use common\models\User;
use consik\yii2websocket\events\WSClientEvent;
use consik\yii2websocket\WebSocketServer;
use Ratchet\ConnectionInterface;
use yii\db\Exception;

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
            try {
                $userModel = User::findOne($client->id);
                $model = new Chat();
                $model->message = $message;
                $model->create_at = time();
                $model->user_id = $userModel->id;
                $model->training_id = $userModel->training_id;
                $model->save();
            }catch (Exception $e){}
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
//            foreach ($this->clients as $chatClient) {
//                if ($chatClient != $client && $chatClient->id == $id) {
//                    $result['message'] = 'This id is used by other user';
//                    $usernameFree = false;
//                    break;
//                }
//            }
//
            if ($usernameFree) {
                $client->name = $name;
                $client->id = $id;
            }
        } else {
            $result['message'] = 'Invalid username';
        }

        $client->send( json_encode($result) );
    }

    public function commandSetCaptain(ConnectionInterface $client, $msg)
    {
        $request = json_decode($msg, true);
        $result = ['message' => 'Captain Set'];

        if (!empty($request['user_id'])
            && !empty($request['training_id'])
            && !empty($request['group'])
            && ($userId = trim($request['user_id']))
            && ($trainingId = trim($request['training_id']))
            && $group = trim($request['group'])) {

            $commandCount = Command::find()
                ->where(['training_id' => $trainingId])
                ->andWhere(['group' => $group])
                ->count();

            if ($commandCount < 1){//1 is temp use 6
                $newCommand = new Command();
                $newCommand->capitan_id = $userId;
                $newCommand->training_id = $trainingId;
                $newCommand->group = $group;
                if ($newCommand->save()){
                    $newCommand->captain->role = 3;
                    $newCommand->captain->command_id = $newCommand->id;
                    $newCommand->captain->save();
                    $client->send(json_encode([
                        'type' => 'setCaptain',
                        'from' =>  $client->id,
                        'message' => 1,
                    ]));
                    if ($commandCount + 1 >= 1){//1 is temp use 6
                        foreach ($this->clients as $amgClient){
                            $user = User::findOne($amgClient->id);
                            if ($user->role === 4){
                                $amgClient->send(json_encode([
                                    'type' => 'setCaptain',
                                    'from' =>  0,
                                    'message' => 0,
                                ]));
                            }
                        }
                    }
                }
            }else{
                foreach ($this->clients as $amgClient){
                    $user = User::findOne($amgClient->id);
                    if ($user->role === 4){
                        $amgClient->send(json_encode([
                            'type' => 'setCaptain',
                            'from' =>  0,
                            'message' => 0,
                        ]));
                    }
                }
            }

        } else {
            $result['message'] = 'Captain NoSet';
        }

        $client->send( json_encode($result) );
    }

    public function commandSelectCommand(ConnectionInterface $client, $msg)
    {
        $request = json_decode($msg, true);
        $result = ['message' => 'Command Select'];

        if (!empty($request['user_id'])
            && !empty($request['commandId'])
            && !empty($request['name'])
            && ($userId = trim($request['user_id']))
            && ($commandId = trim($request['commandId']))
            && ($name = trim($request['name']))) {

            /* @var $commandModel Command*/
            $commandModel = Command::findOne($commandId);
            /* @var $userModel User*/
            $userModel = User::findOne($userId);

            if ($commandModel->isFull === 0){
                if ($commandModel->player_1_id === null){
                    $commandModel->player_1_id = $userId;
                    $from = 'player1';
                }elseif ($commandModel->player_2_id === null){
                    $commandModel->player_2_id = $userId;
                    $from = 'player2';
                }elseif ($commandModel->player_3_id === null){
                    $commandModel->player_3_id = $userId;
                    $from = 'player3';
                    $commandModel->isFull = 1;
                }
                if ($commandModel->save()){
                    $userModel->command_id = $commandId;
                    $userModel->save();
                    foreach ($this->clients as $amgClient){

                        $amgClient->send(json_encode([
                            'type' => 'selectCommand',
                            'from' => ['commandId' => $commandId, 'player' => $from, 'userId' => $client->id],
                            'message' => $name,
                        ]));

                    }
                }
            }else{
                $client->send(json_encode([
                    'type' => 'selectCommand',
                    'from' =>  $client->id,
                    'message' => false,
                ]));
            }

        } else {
            $result['message'] = 'Captain NoSet';
        }

        $client->send( json_encode($result) );
    }

}