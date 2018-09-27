<?php

use yii\db\Migration;

/**
 * Handles the creation of table `XClassDriveAnswerImage`.
 * Has foreign keys to the tables:
 *
 * - `user`
 * - `XClassDriveQuestion`
 */
class m180927_125147_create_XClassDriveAnswerImage_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('XClassDriveAnswerImage', [
            'id' => $this->primaryKey(),
            'image' => $this->string()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'question_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-XClassDriveAnswerImage-user_id',
            'XClassDriveAnswerImage',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-XClassDriveAnswerImage-user_id',
            'XClassDriveAnswerImage',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `question_id`
        $this->createIndex(
            'idx-XClassDriveAnswerImage-question_id',
            'XClassDriveAnswerImage',
            'question_id'
        );

        // add foreign key for table `XClassDriveQuestion`
        $this->addForeignKey(
            'fk-XClassDriveAnswerImage-question_id',
            'XClassDriveAnswerImage',
            'question_id',
            'XClassDriveQuestion',
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
            'fk-XClassDriveAnswerImage-user_id',
            'XClassDriveAnswerImage'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-XClassDriveAnswerImage-user_id',
            'XClassDriveAnswerImage'
        );

        // drops foreign key for table `XClassDriveQuestion`
        $this->dropForeignKey(
            'fk-XClassDriveAnswerImage-question_id',
            'XClassDriveAnswerImage'
        );

        // drops index for column `question_id`
        $this->dropIndex(
            'idx-XClassDriveAnswerImage-question_id',
            'XClassDriveAnswerImage'
        );

        $this->dropTable('XClassDriveAnswerImage');
    }
}
