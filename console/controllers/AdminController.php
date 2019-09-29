<?php
namespace console\controllers;

use common\models\User;
use yii\base\Exception;
use yii\console\Controller;
use yii\helpers\Console;


class AdminController extends Controller
{
    /**
     * @param null $password
     * @throws Exception
     */
    public function actionCreate($password=null)
    {
        if ($password){
            if (!User::findOne(['username' => 'admin'])){
                $user = new User();
                $user->username = 'admin';
                $user->email = 'admin@example.ru';
                $user->role = User::ROLE_ADMIN;
                $user->setPassword($password);
                $user->generateAuthKey();

                if ($user->save()){
                    $this->stdout('success' . PHP_EOL, Console::FG_GREEN);
                }else{
                    $this->stdout('save error' . PHP_EOL, Console::FG_RED);
                }
            } else {
                $this->stdout('user already exists' . PHP_EOL, Console::FG_RED);
            }

        }else{
            $this->stdout('need enter password' . PHP_EOL, Console::FG_YELLOW);
        }
    }

    /**
     * @param null $password
     * @throws Exception
     */
    public function actionPassword($password=null)
    {
        if ($password){
            $user = User::find()->where(['username' => 'admin'])->one();
            $user->setPassword($password);
            $user->generateAuthKey();

            if ($user->save()){
                $this->stdout('success' . PHP_EOL, Console::FG_GREEN);
            }else{
                $this->stdout('save error' . PHP_EOL, Console::FG_RED);
            }
        }else{
            $this->stdout('need enter password' . PHP_EOL, Console::FG_YELLOW);
        }
    }
}