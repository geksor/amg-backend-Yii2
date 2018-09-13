<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "amgStatic_question".
 *
 * @property int $id
 * @property string $title
 * @property string $image_1
 * @property string $image_2
 * @property string $image_3
 * @property int $answerCount
 * @property int $amgStatic_test_id
 *
 * @property AmgStaticAnswer[] $amgStaticAnswers
 * @property AmgStaticTest $amgStaticTest
 */
class AmgStaticQuestion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'amgStatic_question';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['answerCount', 'amgStatic_test_id'], 'integer'],
            [['title', 'image_1', 'image_2', 'image_3'], 'string', 'max' => 255],
            [['amgStatic_test_id'], 'exist', 'skipOnError' => true, 'targetClass' => AmgStaticTest::className(), 'targetAttribute' => ['amgStatic_test_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Вопрос',
            'image_1' => 'Изображение 1',
            'image_2' => 'Изображение 2',
            'image_3' => 'Изображение 3',
            'answerCount' => 'Количество ответов',
            'amgStatic_test_id' => 'Amg Static Test ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAmgStaticAnswers()
    {
        return $this->hasMany(AmgStaticAnswer::className(), ['amgStatic_question_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAmgStaticTest()
    {
        return $this->hasOne(AmgStaticTest::className(), ['id' => 'amgStatic_test_id']);
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
            case 3:
                $this->image_3 = $fileName;
                break;
        }
        return $this->save(false);
    }

    public function getPhotos()
    {
        return [
            'image_1' => ($this->image_1) ? '/uploads/images/' . $this->image_1 : '/no_image.jpg',
            'image_2' => ($this->image_2) ? '/uploads/images/' . $this->image_2 : '/no_image.jpg',
            'image_3' => ($this->image_3) ? '/uploads/images/' . $this->image_3 : '/no_image.jpg',
            'thumb_image_1' => ($this->image_1) ? '/uploads/images/' . 'thumb_' . $this->image_1 : '/no_image.jpg',
            'thumb_image_2' => ($this->image_2) ? '/uploads/images/' . 'thumb_' . $this->image_2 : '/no_image.jpg',
            'thumb_image_3' => ($this->image_3) ? '/uploads/images/' . 'thumb_' . $this->image_3 : '/no_image.jpg',
        ];
    }

    public function deletePhoto()
    {
        $imageUploadModel = new ImageUpload();

        $imageUploadModel->deleteCurrentImage($this->image);
    }

    public function beforeDelete()
    {
        $this->deletePhoto();
        return parent::beforeDelete(); // TODO: Change the autogenerated stub
    }
}