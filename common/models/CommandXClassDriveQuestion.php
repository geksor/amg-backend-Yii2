<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "command_XClassDriveQuestion".
 *
 * @property int $command_id
 * @property int $XClassDriveQuestion_id
 *
 * @property XClassDriveQuestion $xClassDriveQuestion
 * @property Command $command
 */
class CommandXClassDriveQuestion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'command_XClassDriveQuestion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['command_id', 'XClassDriveQuestion_id'], 'required'],
            [['command_id', 'XClassDriveQuestion_id'], 'integer'],
            [['command_id', 'XClassDriveQuestion_id'], 'unique', 'targetAttribute' => ['command_id', 'XClassDriveQuestion_id']],
            [['XClassDriveQuestion_id'], 'exist', 'skipOnError' => true, 'targetClass' => XClassDriveQuestion::className(), 'targetAttribute' => ['XClassDriveQuestion_id' => 'id']],
            [['command_id'], 'exist', 'skipOnError' => true, 'targetClass' => Command::className(), 'targetAttribute' => ['command_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'command_id' => 'Command ID',
            'XClassDriveQuestion_id' => 'Xclass Drive Question ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getXClassDriveQuestion()
    {
        return $this->hasOne(XClassDriveQuestion::className(), ['id' => 'XClassDriveQuestion_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommand()
    {
        return $this->hasOne(Command::className(), ['id' => 'command_id']);
    }
}
