<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $surname;
    public $first_name;
    public $last_name;
    public $group;
    public $training_id;
    public $dealer_center_id;
    public $email;
    public $password;
    public $conformPassword;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Данный E-mail уже используется'],

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
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->email;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        $this->sendEmail($this->email);
        
        return $user->save() ? $user : null;
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail($email)
    {
        $body = 'Логин: '.$email.' Пароль: '.$this->password;

        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom(['support@abs.ru' => 'ABS-Auto'])
            ->setSubject('Регистрация')
            ->setTextBody($body)
            ->send();
    }
}
