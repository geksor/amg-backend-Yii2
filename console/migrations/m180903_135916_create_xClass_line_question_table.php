<?php

use yii\db\Migration;

/**
 * Handles the creation of table `xClass_line_question`.
 * Has foreign keys to the tables:
 *
 * - `xClass_line_test`
 */
class m180903_135916_create_xClass_line_question_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('xClass_line_question', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'leftColumn' => $this->string(),
            'rightColumn' => $this->string(),
            'answerCount' => $this->integer(),
            'xClass_line_test_id' => $this->integer(),
        ]);

        // creates index for column `xClass_line_test_id`
        $this->createIndex(
            'idx-xClass_line_question-xClass_line_test_id',
            'xClass_line_question',
            'xClass_line_test_id'
        );

        // add foreign key for table `xClass_line_test`
        $this->addForeignKey(
            'fk-xClass_line_question-xClass_line_test_id',
            'xClass_line_question',
            'xClass_line_test_id',
            'xClass_line_test',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `xClass_line_test`
        $this->dropForeignKey(
            'fk-xClass_line_question-xClass_line_test_id',
            'xClass_line_question'
        );

        // drops index for column `xClass_line_test_id`
        $this->dropIndex(
            'idx-xClass_line_question-xClass_line_test_id',
            'xClass_line_question'
        );

        $this->dropTable('xClass_line_question');
    }
}
