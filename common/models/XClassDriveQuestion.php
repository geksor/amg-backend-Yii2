<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "XClassDriveQuestion".
 *
 * @property int $id
 * @property string $title
 * @property string $question
 * @property string $question_image
 * @property string $description
 * @property string $request
 * @property string $answer_var_1
 * @property string $answer_var_2
 * @property string $answer_var_3
 * @property string $answer_var_4
 * @property int $answer_isImage
 * @property string $answer_var_5
 * @property string $answer_var_6
 *
 * @property XClassDriveAnswerImage[] $xClassDriveAnswerImages
 * @property CommandXClassDriveQuestion[] $commandXClassDriveQuestions
 * @property Command[] $commands
 */
class XClassDriveQuestion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'XClassDriveQuestion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['question', 'description'], 'string'],
            [['answer_isImage'], 'integer'],
            [['title', 'question_image', 'request', 'answer_var_1', 'answer_var_2', 'answer_var_3', 'answer_var_4', 'answer_var_5', 'answer_var_6'], 'string', 'max' => 255],
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
            'question' => 'Вопрос',
            'question_image' => 'Изображение к вопросу',
            'description' => 'Подсказка',
            'request' => 'Координаты следующей точки',
            'answer_var_1' => 'Вариант ответа 1',
            'answer_var_2' => 'Вариант ответа 2',
            'answer_var_3' => 'Вариант ответа 3',
            'answer_var_4' => 'Вариант ответа 4',
            'answer_isImage' => 'Ответ в виде фото',
            'answer_var_5' => 'Вариант ответа 5',
            'answer_var_6' => 'Вариант ответа 6',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getXClassDriveAnswerImages()
    {
        return $this->hasMany(XClassDriveAnswerImage::className(), ['question_id' => 'id']);
    }

    public function savePhoto($fileName)
    {
        $this->question_image = $fileName;

        return $this->save(false);
    }

    public function getPhotos()
    {
        return [
            'image' => ($this->question_image) ? '/uploads/images/' . $this->question_image : '/no_image.jpg',
            'thumb_image' => ($this->question_image) ? '/uploads/images/' . 'thumb_' . $this->question_image : '/no_image.jpg',
        ];
    }

    public function getThumbPhoto()
    {
        return ($this->question_image) ? '/uploads/images/' . 'thumb_' . $this->question_image : '/no_image.jpg';
    }

    public function deletePhoto()
    {
        $imageUploadModel = new ImageUpload();

        $imageUploadModel->deleteCurrentImage($this->question_image);
    }

    public function beforeDelete()
    {
        $this->deletePhoto();
        return parent::beforeDelete(); // TODO: Change the autogenerated stub
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommandXClassDriveQuestions()
    {
        return $this->hasMany(CommandXClassDriveQuestion::className(), ['XClassDriveQuestion_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommands()
    {
        return $this->hasMany(Command::className(), ['id' => 'command_id'])->viaTable('command_XClassDriveQuestion', ['XClassDriveQuestion_id' => 'id']);
    }

    /**
     * @param $commandId
     * @return bool
     */
    public function isCommandAnswer($commandId)
    {
        foreach ($this->commands as $command)
        {
            if ($command->id === $commandId)
            {
                return true;
            }
        }
        return false;
    }
}
