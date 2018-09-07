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
}
