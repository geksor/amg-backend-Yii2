<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mixStatic_user".
 *
 * @property int $mixStatic_id
 * @property int $user_id
 *
 * @property MixStatic $mixStatic
 * @property User $user
 */
class MixStaticUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mixStatic_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mixStatic_id', 'user_id'], 'required'],
            [['mixStatic_id', 'user_id'], 'integer'],
            [['mixStatic_id', 'user_id'], 'unique', 'targetAttribute' => ['mixStatic_id', 'user_id']],
            [['mixStatic_id'], 'exist', 'skipOnError' => true, 'targetClass' => MixStatic::className(), 'targetAttribute' => ['mixStatic_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'mixStatic_id' => 'Mix Static ID',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMixStatic()
    {
        return $this->hasOne(MixStatic::className(), ['id' => 'mixStatic_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
