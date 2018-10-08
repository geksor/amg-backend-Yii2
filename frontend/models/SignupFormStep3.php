<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupFormStep3 extends Model
{
    public $surname;
    public $first_name;
    public $last_name;
    public $dealer_center_id;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['last_name', 'default', 'value' => ' '],
            [['surname', 'first_name', 'last_name'], 'trim'],
            [['surname', 'first_name', 'dealer_center_id'], 'required']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
          'surname' => 'Фамилия',
          'first_name' => 'Имя',
          'last_name' => 'Отчество',
          'dealer_center_id' => 'Дилерский центр',
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function setValue($userId)
    {
        if (!$this->validate()) {
            return null;
        }

        $user = User::findOne($userId);
        $user->surname = $this->surname;
        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->dealer_center_id = $this->dealer_center_id;
        
        return $user->save() ? $user : null;
    }
}
