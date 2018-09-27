<?php

use yii\db\Migration;

/**
 * Handles the creation of table `XClassDriveQuestion`.
 */
class m180927_124455_create_XClassDriveQuestion_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('XClassDriveQuestion', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'question' => $this->text(),
            'question_image' => $this->string(),
            'description' => $this->text(),
            'request' => $this->string(),
            'answer_var_1' => $this->string(),
            'answer_var_2' => $this->string(),
            'answer_var_3' => $this->string(),
            'answer_var_4' => $this->string(),
            'answer_isImage' => $this->integer(1)->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('XClassDriveQuestion');
    }
}
