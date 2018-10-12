<?php
/**
 * Created by PhpStorm.
 * User: geksor
 * Date: 16.08.2018
 * Time: 13:32
 */

namespace common\models;


use yii\base\Model;
use yii\helpers\VarDumper;
use yii\web\UploadedFile;
use Yii;

/**
 * This is the model class VideoUpload.
 *
 * @property $video
 * @property $title
 *
 */

class VideoUpload extends Model
{
    public $video;
    public $title;

    public function rules()
    {
        return [
            [['video'], 'required'],
            ['video', 'file', 'mimeTypes' => ['video/*'], 'wrongMimeType' => 'Выбранный фаил не является видео',],
            ['video', 'file', 'maxSize' => 1024*1024*50,],
            [['title'], 'trim'],
            [['title'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'video' => 'Видео',
            'title' => 'Заголовок для видео',
        ];
    }

    public function uploadFile(UploadedFile $file, $currentVideo)
    {
        $this->video = $file;

        if ($this->validate())
        {
            $this->deleteCurrentVideo($currentVideo, ['gif', 'mp4', 'webm']);

            return $this->saveVideo();
        }
        return false;
    }


    private  function getFolder()
    {
        return Yii::getAlias('@uploads') . '/videos/';
    }


    private function generateFileName()
    {
        return strtolower(md5(uniqid($this->video->tempName, false)));
    }

    /**
     * @param $currentVideo string
     * @param $extArr array [ string , string , ... ]
     */
    public function deleteCurrentVideo($currentVideo, $extArr)
    {
        foreach ($extArr as $extension){
            if ($this->fileExists($currentVideo, $extension))
            {
                unlink($this->getFolder() . $currentVideo . '.' . $extension);
            }
        }
    }


    public function fileExists($currentVideo, $extension)
    {
        if (!empty($currentVideo) && $currentVideo != null)
        {
            return file_exists($this->getFolder() . $currentVideo . '.' . $extension);
        }
        return false;
    }

    /**
     * @return string
     *
     */
    public function saveVideo()
    {
        $fileName = $this->generateFileName();

        /* @var $file UploadedFile */
        $file = $this->video;

        $argsMp4 = array(
            'type' => 'video',
            'input_file' => $file->tempName,
            'output_file' => $this->getFolder() . $fileName .'.mp4',
            'thumbnail_image' => $this->getFolder() . $fileName .'.gif',
            'thumbnail_generation' => 'yes',
            'thumbnail_size' => '1440x720'
        );

        $argsWebm = array(
            'type' => 'video',
            'input_file' => $file->tempName,
            'output_file' => $this->getFolder() . $fileName .'.webm',
        );

        Yii::$app->ffmpeg->ffmpeg($argsMp4);
        Yii::$app->ffmpeg->ffmpeg($argsWebm);


        return $fileName;
    }

}