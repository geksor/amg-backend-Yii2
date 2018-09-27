<?php


namespace common\models;

use Yii;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "training".
 *
 * @property int $id
 * @property int $date
 *
 * @property Chat[] $chats
 * @property User[] $users
 * @property Command[] $commands
 */
class Training extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'training';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date'], 'required'],
            [['date'], 'checkWeekday'],
            [['date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Дата проведения',
        ];
    }

    public function checkWeekday($attribute)
    {

        $weekday = $this->getWeekday();

        if ($weekday !== 1 && $weekday != 3){
            $this->addError($attribute, 'Дата должна быть понедельником или средой');
        }

    }

    public function getWeekday()
    {
        $date = strtotime($this->date);
        return (integer) date('w', $date);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChats()
    {
        return $this->hasMany(Chat::className(), ['training_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['training_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommands()
    {
        return $this->hasMany(Command::className(), ['training_id' => 'id']);
    }

    public function beforeSave($insert)
    {
        if ($this->date){

            $this->date =
                is_string($this->date)
                    ? strtotime($this->date)
                    : $this->date;
        }

        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

}
