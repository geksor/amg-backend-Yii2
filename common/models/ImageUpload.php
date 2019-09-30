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
use phpDocumentor\Reflection\File;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\helpers\Json;
use yii\imagine\Image;
use yii\web\UploadedFile;
use Yii;

/**
 * This is the model class ImageUpload.
 *
 * @property $image
 * @property $crop_info
 * @property $directory
 *
 */

class ImageUpload extends Model
{
    public $image;
    public $crop_info;
    public $directory;

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
            [['crop_info', 'directory'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'image' => 'Изображение',
        ];
    }

    /**
     * @param UploadedFile $file
     * @param $currentImage
     * @param $cropInfo
     * @return bool|string
     * @throws \yii\base\Exception
     */
    public function uploadFile(UploadedFile $file, $currentImage, $cropInfo, $dir)
    {
        $this->image = $file;
        $this->crop_info = $cropInfo;
        $this->directory = $dir;

        if ($this->validate())
        {
            $this->deleteCurrentImage($currentImage);

            return $this->saveImage();
        }
        return false;
    }


    /**
     * @return string
     * @throws \yii\base\Exception
     */
    private  function getFolder()
    {
        $folder = Yii::getAlias('@uploads') . '/images/' . $this->directory . '/';

        if (!is_dir($folder)){
            FileHelper::createDirectory($folder);
        }

        return $folder;
    }


    private function generateFileName()
    {
        return strtolower(md5(uniqid($this->image->tempName, false)) . '.' . $this->image->extension);
    }


    /**
     * @param $currentImage
     * @throws \yii\base\Exception
     */
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
        if ($this->fileExists('preview_'. $currentImage))
        {
            unlink($this->getPreviewImagePath() . $currentImage);
        }
    }


    /**
     * @param $currentImage
     * @return bool
     * @throws \yii\base\Exception
     */
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

    /**
     * @return string
     * @throws \yii\base\Exception
     */
    public function saveImage()
    {
        $fileName = $this->generateFileName();

        $this->saveThumbnailImage($fileName);

        $this->image->saveAs($this->getFolder() . $fileName);

        return $fileName;
    }

    /**
     * @param $fileName
     * @throws \yii\base\Exception
     */
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

        if (ArrayHelper::keyExists(1, Json::decode($this->crop_info))){
            $imagePrev = Image::getImagine()->open($this->image->tempName);
            $cropInfoPrev = $this->getCropInfo(1);
            $newSizePrev = new Box($cropInfoPrev['dWidth'], $cropInfoPrev['dHeight']);
            $cropSizePrev = new Box($cropInfoPrev['width'], $cropInfoPrev['height']); //frame size of crop
            $cropPointPrev = new Point($cropInfoPrev['x'], $cropInfoPrev['y']);

            $imagePrev->resize($newSizePrev)
                ->crop($cropPointPrev, $cropSizePrev)
                ->save($this->getPreviewImagePath() . $fileName, ['quality' => 60]);
        }
    }

    /**
     * @param int $key
     * @return mixed
     */
    private function getCropInfo($key = 0)
    {
        $cropInfo = Json::decode($this->crop_info)[$key];
        $cropInfo['dWidth'] = (int)$cropInfo['dWidth']; //new width image
        $cropInfo['dHeight'] = (int)$cropInfo['dHeight']; //new height image
        $cropInfo['x'] = abs($cropInfo['x']); //begin position of frame crop by X
        $cropInfo['y'] = abs($cropInfo['y']); //begin position of frame crop by Y
        $cropInfo['width'] = (int)$cropInfo['width']; //width of cropped image
        $cropInfo['height'] = (int)$cropInfo['height']; //height of cropped image

        return $cropInfo;
    }

    /**
     * @return string
     * @throws \yii\base\Exception
     */
    public function getThumbImagePath()
    {
        return $this->getFolder() . '/thumb_';
    }

    /**
     * @return string
     * @throws \yii\base\Exception
     */
    public function getPreviewImagePath()
    {
        return $this->getFolder() . '/preview_';
    }

}