<?php

use yii\db\Migration;

/**
 * Handles the creation of table `quiz`.
 */
class m180903_140313_create_quiz_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('quiz', [
            'id' => $this->primaryKey(),
            'image' => $this->string(),
            'question' => $this->string(),
            'answer_1' => $this->string(),
            'answer_2' => $this->string(),
            'answer_3' => $this->string(),
            'answer_4' => $this->string(),
            'isTrue_1' => $this->integer(1),
            'isTrue_2' => $this->integer(1),
            'isTrue_3' => $this->integer(1),
            'isTrue_4' => $this->integer(1),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('quiz');
    }
}
