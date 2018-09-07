<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "command".
 *
 * @property int $id
 * @property int $commandNumber
 *
 * @property User[] $users
 * @property XClassDriveTest[] $xClassDriveTests
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
            [['commandNumber'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'commandNumber' => 'Command Number',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['command_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getXClassDriveTests()
    {
        return $this->hasMany(XClassDriveTest::className(), ['command_id' => 'id']);
    }
}
