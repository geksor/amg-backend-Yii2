<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_xClass_line_question`.
 * Has foreign keys to the tables:
 *
 * - `user`
 * - `xClass_line_question`
 */
class m180925_141932_create_junction_table_for_user_and_xClass_line_question_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user_xClass_line_question', [
            'user_id' => $this->integer(),
            'xClass_line_question_id' => $this->integer(),
            'PRIMARY KEY(user_id, xClass_line_question_id)',
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-user_xClass_line_question-user_id',
            'user_xClass_line_question',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-user_xClass_line_question-user_id',
            'user_xClass_line_question',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `xClass_line_question_id`
        $this->createIndex(
            'idx-user_xClass_line_question-xClass_line_question_id',
            'user_xClass_line_question',
            'xClass_line_question_id'
        );

        // add foreign key for table `xClass_line_question`
        $this->addForeignKey(
            'fk-user_xClass_line_question-xClass_line_question_id',
            'user_xClass_line_question',
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
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-user_xClass_line_question-user_id',
            'user_xClass_line_question'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-user_xClass_line_question-user_id',
            'user_xClass_line_question'
        );

        // drops foreign key for table `xClass_line_question`
        $this->dropForeignKey(
            'fk-user_xClass_line_question-xClass_line_question_id',
            'user_xClass_line_question'
        );

        // drops index for column `xClass_line_question_id`
        $this->dropIndex(
            'idx-user_xClass_line_question-xClass_line_question_id',
            'user_xClass_line_question'
        );

        $this->dropTable('user_xClass_line_question');
    }
}
