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
            'question' => $this->string(),
            'answer_1' => $this->string(),
            'answer_2' => $this->string(),
            'answer_3' => $this->string(),
            'answer_4' => $this->string(),
            'trueAnswer' => $this->integer(1),
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
