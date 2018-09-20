<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gallery_image".
 *
 * @property int $id
 * @property string $type
 * @property int $ownerId
 * @property int $rank
 * @property string $name
 * @property string $description
 * @property int $rating
 * @property int $voteCount
 *
 * @property MixStatic $owner
 * @property UserGalleryImage[] $userGalleryImages
 * @property User[] $users
 *
 */
class GalleryImage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gallery_image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ownerId', 'rank', 'rating', 'voteCount'], 'integer'],
            [['description'], 'string'],
            [['type', 'name'], 'string', 'max' => 255],
            [['ownerId'], 'exist', 'skipOnError' => true, 'targetClass' => MixStatic::className(), 'targetAttribute' => ['ownerId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'ownerId' => 'Owner ID',
            'rank' => 'Rank',
            'name' => 'Name',
            'description' => 'Description',
            'rating' => 'Rating',
            'voteCount' => 'Vote Count',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwner()
    {
        return $this->hasOne(MixStatic::className(), ['id' => 'ownerId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserGalleryImages()
    {
        return $this->hasMany(UserGalleryImage::className(), ['gallery_image_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('user_gallery_image', ['gallery_image_id' => 'id']);
    }
}
