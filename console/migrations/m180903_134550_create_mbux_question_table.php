<?php

use yii\db\Migration;

/**
 * Handles the creation of table `mbux_question`.
 * Has foreign keys to the tables:
 *
 * - `mbux_test`
 */
class m180903_134550_create_mbux_question_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('mbux_question', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'description' => $this->string(),
            'image_1' => $this->string(),
            'image_2' => $this->string(),
            'mbux_test_id' => $this->integer(),
        ]);

        // creates index for column `mbux_test_id`
        $this->createIndex(
            'idx-mbux_question-mbux_test_id',
            'mbux_question',
            'mbux_test_id'
        );

        // add foreign key for table `mbux_test`
        $this->addForeignKey(
            'fk-mbux_question-mbux_test_id',
            'mbux_question',
            'mbux_test_id',
            'mbux_test',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `mbux_test`
        $this->dropForeignKey(
            'fk-mbux_question-mbux_test_id',
            'mbux_question'
        );

        // drops index for column `mbux_test_id`
        $this->dropIndex(
            'idx-mbux_question-mbux_test_id',
            'mbux_question'
        );

        $this->dropTable('mbux_question');
    }
}
