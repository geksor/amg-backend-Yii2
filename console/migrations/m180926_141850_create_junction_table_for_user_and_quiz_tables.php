<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_quiz`.
 * Has foreign keys to the tables:
 *
 * - `user`
 * - `quiz`
 */
class m180926_141850_create_junction_table_for_user_and_quiz_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user_quiz', [
            'user_id' => $this->integer(),
            'quiz_id' => $this->integer(),
            'PRIMARY KEY(user_id, quiz_id)',
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-user_quiz-user_id',
            'user_quiz',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-user_quiz-user_id',
            'user_quiz',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `quiz_id`
        $this->createIndex(
            'idx-user_quiz-quiz_id',
            'user_quiz',
            'quiz_id'
        );

        // add foreign key for table `quiz`
        $this->addForeignKey(
            'fk-user_quiz-quiz_id',
            'user_quiz',
            'quiz_id',
            'quiz',
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
            'fk-user_quiz-user_id',
            'user_quiz'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-user_quiz-user_id',
            'user_quiz'
        );

        // drops foreign key for table `quiz`
        $this->dropForeignKey(
            'fk-user_quiz-quiz_id',
            'user_quiz'
        );

        // drops index for column `quiz_id`
        $this->dropIndex(
            'idx-user_quiz-quiz_id',
            'user_quiz'
        );

        $this->dropTable('user_quiz');
    }
}
