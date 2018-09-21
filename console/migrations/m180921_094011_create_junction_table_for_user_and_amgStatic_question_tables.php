<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_amgStatic_question`.
 * Has foreign keys to the tables:
 *
 * - `user`
 * - `amgStatic_question`
 */
class m180921_094011_create_junction_table_for_user_and_amgStatic_question_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user_amgStatic_question', [
            'user_id' => $this->integer(),
            'amgStatic_question_id' => $this->integer(),
            'PRIMARY KEY(user_id, amgStatic_question_id)',
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-user_amgStatic_question-user_id',
            'user_amgStatic_question',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-user_amgStatic_question-user_id',
            'user_amgStatic_question',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `amgStatic_question_id`
        $this->createIndex(
            'idx-user_amgStatic_question-amgStatic_question_id',
            'user_amgStatic_question',
            'amgStatic_question_id'
        );

        // add foreign key for table `amgStatic_question`
        $this->addForeignKey(
            'fk-user_amgStatic_question-amgStatic_question_id',
            'user_amgStatic_question',
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
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-user_amgStatic_question-user_id',
            'user_amgStatic_question'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-user_amgStatic_question-user_id',
            'user_amgStatic_question'
        );

        // drops foreign key for table `amgStatic_question`
        $this->dropForeignKey(
            'fk-user_amgStatic_question-amgStatic_question_id',
            'user_amgStatic_question'
        );

        // drops index for column `amgStatic_question_id`
        $this->dropIndex(
            'idx-user_amgStatic_question-amgStatic_question_id',
            'user_amgStatic_question'
        );

        $this->dropTable('user_amgStatic_question');
    }
}
