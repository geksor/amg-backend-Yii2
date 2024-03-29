<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "amgDrive".
 *
 * @property int $id
 * @property string $photo
 * @property int $user_id
 *
 * @property User $user
 */
class AmgDrive extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'amgDrive';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['photo'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'photo' => 'Фото',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function savePhoto($fileName)
    {
        $this->photo = $fileName;

        return $this->save(false);
    }

    public function getPhoto()
    {
        return ($this->photo) ? '/uploads/images/' . $this->photo : '/public/images/noimage.svg';
    }
}
