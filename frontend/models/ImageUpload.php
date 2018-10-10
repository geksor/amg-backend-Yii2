<?php
/**
 * Created by PhpStorm.
 * User: geksor
 * Date: 16.08.2018
 * Time: 13:32
 */

namespace frontend\models;


use yii\base\Model;
use yii\helpers\VarDumper;
use yii\imagine\Image;
use yii\web\UploadedFile;
use Yii;

/**
 * This is the model class ImageUpload.
 *
 * @property $image
 *
 */

class ImageUpload extends Model
{
    public $image;

    public function rules()
    {
        return [
            [['image'], 'required', 'message' => ''],
            [
                'image',
                'image',
                'extensions' => ['jpg', 'jpeg', 'png', 'gif'],
                'mimeTypes' => ['image/jpeg', 'image/pjpeg', 'image/png', 'image/gif'],
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'image' => 'Фото',
        ];
    }

    public function uploadFile(UploadedFile $file, $currentImage)
    {
        $this->image = $file;

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
    }


    public function fileExists($currentImage)
    {
        if (!empty($currentImage) && $currentImage != null)
        {
            return file_exists($this->getFolder() . $currentImage);
        }
        return false;
    }

    public function saveImage()
    {
        $fileName = $this->generateFileName();

        Image::autorotate($this->image->tempName)->save($this->getFolder() . $fileName, ['quality' => 40]);
        Image::autorotate($this->image->tempName)->save($this->getFolder() . 'full_' . $fileName);

        return $fileName;
    }

}