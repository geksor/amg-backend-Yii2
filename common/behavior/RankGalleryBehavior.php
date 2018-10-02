<?php
/**
 * Created by PhpStorm.
 * User: Geksar
 * Date: 02.10.2018
 * Time: 9:49
 */
namespace common\behavior;

use zxbodya\yii2\galleryManager\GalleryBehavior;


class RankGalleryBehavior extends GalleryBehavior
{
    /**
     * @return RankGalleryImage[]
     */
    public function getImages()
    {
        if ($this->_images === null) {
            $query = new \yii\db\Query();

            $imagesData = $query
                ->select(['id', 'name', 'description', 'rank', 'rating', 'voteCount'])
                ->from($this->tableName)
                ->where(['type' => $this->type, 'ownerId' => $this->getGalleryId()])
                ->orderBy(['rank' => 'asc'])
                ->all();

            $this->_images = [];
            foreach ($imagesData as $imageData) {
                $this->_images[] = new RankGalleryImage($this, $imageData);
            }
        }

        return $this->_images;
    }

}