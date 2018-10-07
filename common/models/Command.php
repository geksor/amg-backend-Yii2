<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "command".
 *
 * @property int $id
 * @property int $capitan_id
 * @property int $player_1_id
 * @property int $player_2_id
 * @property int $player_3_id
 * @property int $training_id
 * @property int $group
 * @property int $isFull
 * @property string $image
 *
 * @property User [] $captain
 * @property User [] $player1
 * @property User [] $player2
 * @property User [] $player3
 * @property Training $training
 * @property CommandXClassDriveQuestion[] $commandXClassDriveQuestions
 * @property XClassDriveQuestion[] $xClassDriveQuestions
 */
class Command extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'command';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['capitan_id', 'training_id', 'group'], 'required'],
            [['capitan_id', 'player_1_id', 'player_2_id', 'player_3_id', 'training_id', 'group', 'isFull'], 'integer'],
            [['image'], 'string', 'max' => 255],
            [['capitan_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['capitan_id' => 'id']],
            [['player_1_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['player_1_id' => 'id']],
            [['player_2_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['player_2_id' => 'id']],
            [['player_3_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['player_3_id' => 'id']],
            [['training_id'], 'exist', 'skipOnError' => true, 'targetClass' => Training::className(), 'targetAttribute' => ['training_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'capitan_id' => 'Capitan ID',
            'player_1_id' => 'Player 1 ID',
            'player_2_id' => 'Player 2 ID',
            'player_3_id' => 'Player 3 ID',
            'training_id' => 'Training ID',
            'group' => 'Group',
            'isFull' => 'Is Full',
            'image' => 'Image',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCaptain()
    {
        return $this->hasOne(User::className(), ['id' => 'capitan_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlayer1()
    {
        return $this->hasOne(User::className(), ['id' => 'player_1_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlayer2()
    {
        return $this->hasOne(User::className(), ['id' => 'player_2_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlayer3()
    {
        return $this->hasOne(User::className(), ['id' => 'player_3_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTraining()
    {
        return $this->hasOne(Training::className(), ['id' => 'training_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommandXClassDriveQuestions()
    {
        return $this->hasMany(CommandXClassDriveQuestion::className(), ['command_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getXClassDriveQuestions()
    {
        return $this->hasMany(XClassDriveQuestion::className(), ['id' => 'XClassDriveQuestion_id'])->viaTable('command_XClassDriveQuestion', ['command_id' => 'id']);
    }

    /**
     * @param $questId XClassDriveQuestion
     * @return string
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function saveQuestion($questId)
    {
        if ($questId){
            if ($link = CommandXClassDriveQuestion::find()->where(['XClassDriveQuestion_id' => $questId])->one()){
                $link->delete();
            }

            /* @var $question XClassDriveQuestion */
            $question = XClassDriveQuestion::findOne($questId);

            $this->link('xClassDriveQuestions', $question);

            return $question->request;
        }

        return false;
    }


    /**
     * @param $questId
     * @param $fileName
     * @return bool|string
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function saveQuestionIsImage($questId, $fileName)
    {
        if ($questId){
            if ($link = CommandXClassDriveQuestion::find()->where(['XClassDriveQuestion_id' => $questId])->one()){
                $link->delete();
            }

            $this->image = $fileName;
            $this->save(false);

            /* @var $question XClassDriveQuestion */
            $question = XClassDriveQuestion::findOne($questId);

            $this->link('xClassDriveQuestions', $question);

            return $question->request;
        }

        return false;
    }

    public function getPhoto()
    {
        return ($this->image) ? '/uploads/images/' . $this->image : '/public/images/noimage.svg';
    }
}
