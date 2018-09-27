<?php

use yii\db\Migration;

/**
 * Handles the creation of table `chat`.
 * Has foreign keys to the tables:
 *
 * - `user`
 * - `training`
 */
class m180927_064527_create_chat_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('chat', [
            'id' => $this->primaryKey(),
            'message' => $this->text(),
            'create_at' => $this->integer(),
            'user_id' => $this->integer()->notNull(),
            'training_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-chat-user_id',
            'chat',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-chat-user_id',
            'chat',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `training_id`
        $this->createIndex(
            'idx-chat-training_id',
            'chat',
            'training_id'
        );

        // add foreign key for table `training`
        $this->addForeignKey(
            'fk-chat-training_id',
            'chat',
            'training_id',
            'training',
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
            'fk-chat-user_id',
            'chat'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-chat-user_id',
            'chat'
        );

        // drops foreign key for table `training`
        $this->dropForeignKey(
            'fk-chat-training_id',
            'chat'
        );

        // drops index for column `training_id`
        $this->dropIndex(
            'idx-chat-training_id',
            'chat'
        );

        $this->dropTable('chat');
    }
}
