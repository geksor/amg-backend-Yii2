<?php

use yii\db\Migration;

/**
 * Handles the creation of table `xClass_line_answer`.
 * Has foreign keys to the tables:
 *
 * - `xClass_line_question`
 */
class m180903_140148_create_xClass_line_answer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('xClass_line_answer', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'image' => $this->string(),
            'column' => $this->integer(1),
            'xClass_line_question_id' => $this->integer(),
        ]);

        // creates index for column `xClass_line_question_id`
        $this->createIndex(
            'idx-xClass_line_answer-xClass_line_question_id',
            'xClass_line_answer',
            'xClass_line_question_id'
        );

        // add foreign key for table `xClass_line_question`
        $this->addForeignKey(
            'fk-xClass_line_answer-xClass_line_question_id',
            'xClass_line_answer',
            'xClass_line_question_id',
            'xClass_line_question',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `xClass_line_question`
        $this->dropForeignKey(
            'fk-xClass_line_answer-xClass_line_question_id',
            'xClass_line_answer'
        );

        // drops index for column `xClass_line_question_id`
        $this->dropIndex(
            'idx-xClass_line_answer-xClass_line_question_id',
            'xClass_line_answer'
        );

        $this->dropTable('xClass_line_answer');
    }
}
