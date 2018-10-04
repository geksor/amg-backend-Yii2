<?php
namespace backend\models;

use common\models\Trainer;
use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class ChangePassword extends Model
{
    public $userId;
    public $password;
    public $conformPassword;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['conformPassword', 'required'],
            ['conformPassword', 'compare', 'compareAttribute' => 'password'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
          'conformPassword' => 'Подтверждение пароля',
          'password' => 'Пароль'
        ];
    }

    /**
     * Signs user up.
     *
     * @throws \yii\base\Exception
     */
    public function setPassword()
    {
        if (!$this->validate()) {
            return null;
        }
        /* @var $user User */
        $user = User::findOne($this->userId);
        $user->setPassword($this->password);
        $user->generatePasswordResetToken();
        $user->generateAuthKey();

        return $user->save() ? true : null;
    }
}
