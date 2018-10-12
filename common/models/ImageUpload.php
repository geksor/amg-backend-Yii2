<?php
/**
 * Created by PhpStorm.
 * User: geksor
 * Date: 16.08.2018
 * Time: 13:32
 */

namespace common\models;


use Imagine\Image\Box;
use Imagine\Image\Point;
use yii\base\Model;
use yii\helpers\Json;
use yii\imagine\Image;
use yii\web\UploadedFile;
use Yii;

/**
 * This is the model class ImageUpload.
 *
 * @property $image
 * @property $crop_info
 *
 */

class ImageUpload extends Model
{
    public $image;
    public $crop_info;

    public function rules()
    {
        return [
            [['image'], 'required'],
            [
                'image',
                'image',
                'extensions' => ['jpg', 'jpeg', 'png', 'gif'],
                'mimeTypes' => ['image/jpeg', 'image/pjpeg', 'image/png', 'image/gif'],
            ],
            ['crop_info', 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'image' => 'Изображение',
        ];
    }

    public function uploadFile(UploadedFile $file, $currentImage, $cropInfo)
    {
        $this->image = $file;
        $this->crop_info = $cropInfo;

        if ($this->validate())
        {
            $this->deleteCurrentImage($currentImage);

            return $this->saveImage();
        }
        return false;
    }


    private  function getFolder()
    {
        return Yii::getAlias('@uploads') . '/images/';
    }


    private function generateFileName()
    {
        return strtolower(md5(uniqid($this->image->tempName, false)) . '.' . $this->image->extension);
    }


    public function deleteCurrentImage($currentImage)
    {
        if ($this->fileExists($currentImage))
        {
            unlink($this->getFolder() . $currentImage);
        }
        if ($this->fileExists('thumb_'. $currentImage))
        {
            unlink($this->getThumbImagePath() . $currentImage);
        }
    }


    public function fileExists($currentImage)
    {
        if (!empty($currentImage) && $currentImage != null)
        {
            return file_exists($this->getFolder() . $currentImage);
        }
        return false;
    }

//    public function saveImage()
//    {
//        $fileName = $this->generateFileName();
//
//        $this->image->saveAs($this->getFolder() . $fileName);
//
//        return $fileName;
//    }

    public function saveImage()
    {
        $fileName = $this->generateFileName();

        $this->saveThumbnailImage($fileName);

        $this->image->saveAs($this->getFolder() . $fileName);

        return $fileName;
    }

    private function saveThumbnailImage($fileName)
    {
        // open image
        $image = Image::getImagine()->open($this->image->tempName);

        // rendering information about crop of ONE option
        $cropInfo = $this->getCropInfo();

        //saving thumbnail
        $newSizeThumb = new Box($cropInfo['dWidth'], $cropInfo['dHeight']);
        $cropSizeThumb = new Box($cropInfo['width'], $cropInfo['height']); //frame size of crop
        $cropPointThumb = new Point($cropInfo['x'], $cropInfo['y']);

        $image->resize($newSizeThumb)
            ->crop($cropPointThumb, $cropSizeThumb)
            ->save($this->getThumbImagePath() . $fileName, ['quality' => 100]);
    }

    private function getCropInfo()
    {
        $cropInfo = Json::decode($this->crop_info)[0];
        $cropInfo['dWidth'] = (int)$cropInfo['dWidth']; //new width image
        $cropInfo['dHeight'] = (int)$cropInfo['dHeight']; //new height image
        $cropInfo['x'] = $cropInfo['x']; //begin position of frame crop by X
        $cropInfo['y'] = $cropInfo['y']; //begin position of frame crop by Y
        $cropInfo['width'] = (int)$cropInfo['width']; //width of cropped image
        $cropInfo['height'] = (int)$cropInfo['height']; //height of cropped image

        return $cropInfo;
    }

    public function getThumbImagePath()
    {
        return $this->getFolder() . '/thumb_';
    }

}