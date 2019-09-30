<?php
/**
 * Created by PhpStorm.
 * User: geksor
 * Date: 16.08.2018
 * Time: 13:32
 */

namespace common\behaviors;


use common\models\ImageUpload;
use yii\base\Behavior;
use yii\db\ActiveRecord;

/**
 * This is the model class ImgUploadBehavior.
 *
 * @property $propImage
 * @property $noImage
 * @property $folder
 *
 */

class ImgUploadBehavior extends Behavior
{
    public $propImage;
    public $noImage;
    public $folder;


    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_DELETE => 'beforeDelete',
        ];
    }
    /**
     * @param $fileName
     * @return bool
     */
    public function saveImage($fileName, $propImage=null, $fromModel=null)
    {
        $image = $propImage?$propImage:$this->propImage;
        $this->owner->$image = $fileName;

        if ($fromModel){
            return $this->owner->save($fromModel);
        }
        return $this->owner->save(false);
    }

    /**
     * @return string
     */
    public function getImageIsSet($propImage=null)
    {
        $image = $propImage?$propImage:$this->propImage;
        return ($this->owner->$image) ? true : false;
    }

    /**
     * @return string
     */
    public function getImage($propImage=null)
    {
        $image = $propImage?$propImage:$this->propImage;
        return ($this->owner->$image) ? $this->folder . '/' . $this->owner->$image : "/$this->noImage";
    }

    /**
     * @return string
     */
    public function getThumbImage($propImage=null)
    {
        $image = $propImage?$propImage:$this->propImage;
        return ($this->owner->$image) ? $this->folder . '/' . 'thumb_' . $this->owner->$image : "/$this->noImage";
    }

    /**
     * @return string
     */
    public function getPrevImage($propImage=null)
    {
        $image = $propImage?$propImage:$this->propImage;
        return ($this->owner->$image) ? $this->folder . '/' . 'preview_' . $this->owner->$image : "/$this->noImage";
    }

    /**
     * @throws \yii\base\Exception
     */
    public function deleteImage($propImage=null)
    {
        $imageUploadModel = new ImageUpload();

        $image = $propImage?$propImage:$this->propImage;
        $imageUploadModel->deleteCurrentImage($this->owner->$image);
    }

    /**
     * @throws \yii\base\Exception
     */
    public function beforeDelete()
    {
        $this->deleteImage();
    }
}