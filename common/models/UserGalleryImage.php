<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_gallery_image".
 *
 * @property int $user_id
 * @property int $gallery_image_id
 *
 * @property GalleryImage $galleryImage
 * @property User $user
 */
class UserGalleryImage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_gallery_image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'gallery_image_id'], 'required'],
            [['user_id', 'gallery_image_id'], 'integer'],
            [['user_id', 'gallery_image_id'], 'unique', 'targetAttribute' => ['user_id', 'gallery_image_id']],
            [['gallery_image_id'], 'exist', 'skipOnError' => true, 'targetClass' => GalleryImage::className(), 'targetAttribute' => ['gallery_image_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'gallery_image_id' => 'Gallery Image ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGalleryImage()
    {
        return $this->hasOne(GalleryImage::className(), ['id' => 'gallery_image_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
