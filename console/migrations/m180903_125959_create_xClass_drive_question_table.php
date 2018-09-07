<?php

use yii\db\Migration;

/**
 * Handles the creation of table `xClass_drive_question`.
 * Has foreign keys to the tables:
 *
 * - `xClass_drive_test`
 */
class m180903_125959_create_xClass_drive_question_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('xClass_drive_question', [
            'id' => $this->primaryKey(),
            'question' => $this->string(),
            'answer_1' => $this->string(),
            'answer_2' => $this->string(),
            'answer_3' => $this->string(),
            'answer_4' => $this->string(),
            'trueAnswer' => $this->string(),
            'xClass_drive_test_id' => $this->integer(),
        ]);

        // creates index for column `xClass_drive_test_id`
        $this->createIndex(
            'idx-xClass_drive_question-xClass_drive_test_id',
            'xClass_drive_question',
            'xClass_drive_test_id'
        );

        // add foreign key for table `xClass_drive_test`
        $this->addForeignKey(
            'fk-xClass_drive_question-xClass_drive_test_id',
            'xClass_drive_question',
            'xClass_drive_test_id',
            'xClass_drive_test',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `xClass_drive_test`
        $this->dropForeignKey(
            'fk-xClass_drive_question-xClass_drive_test_id',
            'xClass_drive_question'
        );

        // drops index for column `xClass_drive_test_id`
        $this->dropIndex(
            'idx-xClass_drive_question-xClass_drive_test_id',
            'xClass_drive_question'
        );

        $this->dropTable('xClass_drive_question');
    }
}
