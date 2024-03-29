<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mbux_question".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $image_1
 * @property string $image_2
 * @property int $mbux_test_id
 *
 * @property MbuxTest $mbuxTest
 */
class MbuxQuestion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mbux_question';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mbux_test_id'], 'integer'],
            [['title', 'description', 'image_1', 'image_2'], 'string', 'max' => 255],
            [['mbux_test_id'], 'exist', 'skipOnError' => true, 'targetClass' => MbuxTest::className(), 'targetAttribute' => ['mbux_test_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'description' => 'Подсказка',
            'image_1' => 'Картинка 1',
            'image_2' => 'Картинка 2',
            'mbux_test_id' => 'Mbux Test ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMbuxTest()
    {
        return $this->hasOne(MbuxTest::className(), ['id' => 'mbux_test_id']);
    }

    public function savePhoto($fileName, $image)
    {
        switch ($image){
            case 1:
                $this->image_1 = $fileName;
                break;
            case 2:
                $this->image_2 = $fileName;
                break;
        }
        return $this->save(false);
    }

    public function getPhotos()
    {
        return [
            'image_1' => ($this->image_1) ? '/uploads/images/' . $this->image_1 : '/no_image.jpg',
            'image_2' => ($this->image_2) ? '/uploads/images/' . $this->image_2 : '/no_image.jpg',
            'thumb_image_1' => ($this->image_1) ? '/uploads/images/' . 'thumb_' . $this->image_1 : '/no_image.jpg',
            'thumb_image_2' => ($this->image_2) ? '/uploads/images/' . 'thumb_' . $this->image_2 : '/no_image.jpg',
        ];
    }

    public function deletePhoto()
    {
        $imageUploadModel = new ImageUpload();

        $imageUploadModel->deleteCurrentImage($this->image_1);
        $imageUploadModel->deleteCurrentImage($this->image_2);
    }

    public function beforeDelete()
    {
        $this->deletePhoto();
        return parent::beforeDelete(); // TODO: Change the autogenerated stub
    }
}
