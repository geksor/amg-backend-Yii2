<?php

use yii\db\Migration;

/**
 * Handles the creation of table `amgStatic_question`.
 * Has foreign keys to the tables:
 *
 * - `amgStatic_test`
 */
class m180903_132815_create_amgStatic_question_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('amgStatic_question', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'image_1' => $this->string(),
            'image_2' => $this->string(),
            'image_3' => $this->string(),
            'answerCount' => $this->integer(),
            'amgStatic_test_id' => $this->integer(),
        ]);

        // creates index for column `amgStatic_test_id`
        $this->createIndex(
            'idx-amgStatic_question-amgStatic_test_id',
            'amgStatic_question',
            'amgStatic_test_id'
        );

        // add foreign key for table `amgStatic_test`
        $this->addForeignKey(
            'fk-amgStatic_question-amgStatic_test_id',
            'amgStatic_question',
            'amgStatic_test_id',
            'amgStatic_test',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `amgStatic_test`
        $this->dropForeignKey(
            'fk-amgStatic_question-amgStatic_test_id',
            'amgStatic_question'
        );

        // drops index for column `amgStatic_test_id`
        $this->dropIndex(
            'idx-amgStatic_question-amgStatic_test_id',
            'amgStatic_question'
        );

        $this->dropTable('amgStatic_question');
    }
}
