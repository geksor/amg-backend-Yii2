<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupFormStep2 extends Model
{
    public $group;
    public $training_id;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['group', 'training_id'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
          'group' => 'Номер группы',
          'training_id' => 'Дата начала тренинга',
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
        $user->group = $this->group;
        $user->training_id = $this->training_id;

        return $user->save() ? $user : null;
    }
}
