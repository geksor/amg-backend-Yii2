<?php

use yii\db\Migration;

/**
 * Handles the creation of table `amgStatic_answer`.
 * Has foreign keys to the tables:
 *
 * - `amgStatic_question`
 */
class m180903_134207_create_amgStatic_answer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('amgStatic_answer', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'rank' => $this->integer(),
            'trueImage' => $this->integer(),
            'amgStatic_question_id' => $this->integer(),
        ]);

        // creates index for column `amgStatic_question_id`
        $this->createIndex(
            'idx-amgStatic_answer-amgStatic_question_id',
            'amgStatic_answer',
            'amgStatic_question_id'
        );

        // add foreign key for table `amgStatic_question`
        $this->addForeignKey(
            'fk-amgStatic_answer-amgStatic_question_id',
            'amgStatic_answer',
            'amgStatic_question_id',
            'amgStatic_question',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `amgStatic_question`
        $this->dropForeignKey(
            'fk-amgStatic_answer-amgStatic_question_id',
            'amgStatic_answer'
        );

        // drops index for column `amgStatic_question_id`
        $this->dropIndex(
            'idx-amgStatic_answer-amgStatic_question_id',
            'amgStatic_answer'
        );

        $this->dropTable('amgStatic_answer');
    }
}
