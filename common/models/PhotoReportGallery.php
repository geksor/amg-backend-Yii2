<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "photoReport_gallery".
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
 * @property PhotoReport $owner
 */
class PhotoReportGallery extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'photoReport_gallery';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ownerId'], 'required'],
            [['ownerId', 'rank', 'rating', 'voteCount'], 'integer'],
            [['description'], 'string'],
            [['type', 'name'], 'string', 'max' => 255],
            [['ownerId'], 'exist', 'skipOnError' => true, 'targetClass' => PhotoReport::className(), 'targetAttribute' => ['ownerId' => 'id']],
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
        return $this->hasOne(PhotoReport::className(), ['id' => 'ownerId']);
    }
}
