<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "xClass_drive_test".
 *
 * @property int $id
 * @property string $point_1_img
 * @property string $point_2_img
 * @property string $point_3_img
 * @property string $point_1_link
 * @property string $point_2_link
 * @property string $point_3_link
 * @property string $point_1_desc
 * @property string $point_2_desc
 * @property string $point_3_desc
 * @property int $command_id
 *
 * @property XClassDriveQuestion[] $xClassDriveQuestions
 * @property Command $command
 */
class XClassDriveTest extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'xClass_drive_test';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['command_id'], 'integer'],
            [['point_1_img', 'point_2_img', 'point_3_img', 'point_1_link', 'point_2_link', 'point_3_link', 'point_1_desc', 'point_2_desc', 'point_3_desc'], 'string', 'max' => 255],
            [['command_id'], 'exist', 'skipOnError' => true, 'targetClass' => Command::className(), 'targetAttribute' => ['command_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'point_1_img' => 'Point 1 Img',
            'point_2_img' => 'Point 2 Img',
            'point_3_img' => 'Point 3 Img',
            'point_1_link' => 'Point 1 Link',
            'point_2_link' => 'Point 2 Link',
            'point_3_link' => 'Point 3 Link',
            'point_1_desc' => 'Point 1 Desc',
            'point_2_desc' => 'Point 2 Desc',
            'point_3_desc' => 'Point 3 Desc',
            'command_id' => 'Command ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getXClassDriveQuestions()
    {
        return $this->hasMany(XClassDriveQuestion::className(), ['xClass_drive_test_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommand()
    {
        return $this->hasOne(Command::className(), ['id' => 'command_id']);
    }

}
