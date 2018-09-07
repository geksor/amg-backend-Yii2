<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dealer_center".
 *
 * @property int $id
 * @property string $title
 *
 * @property User[] $users
 */
class DealerCenter extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dealer_center';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название диллерского центра',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['dealer_center_id' => 'id']);
    }
}
