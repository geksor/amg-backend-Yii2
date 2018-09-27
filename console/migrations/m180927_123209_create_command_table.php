<?php

use yii\db\Migration;

/**
 * Handles the creation of table `command`.
 * Has foreign keys to the tables:
 *
 * - `user`
 * - `user`
 * - `user`
 * - `user`
 * - `training`
 */
class m180927_123209_create_command_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('command', [
            'id' => $this->primaryKey(),
            'capitan_id' => $this->integer()->notNull(),
            'player_1_id' => $this->integer(),
            'player_2_id' => $this->integer(),
            'player_3_id' => $this->integer(),
            'training_id' => $this->integer()->notNull(),
            'group' => $this->integer()->notNull(),
        ]);

        // creates index for column `capitan_id`
        $this->createIndex(
            'idx-command-capitan_id',
            'command',
            'capitan_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-command-capitan_id',
            'command',
            'capitan_id',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `player_1_id`
        $this->createIndex(
            'idx-command-player_1_id',
            'command',
            'player_1_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-command-player_1_id',
            'command',
            'player_1_id',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `player_2_id`
        $this->createIndex(
            'idx-command-player_2_id',
            'command',
            'player_2_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-command-player_2_id',
            'command',
            'player_2_id',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `player_3_id`
        $this->createIndex(
            'idx-command-player_3_id',
            'command',
            'player_3_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-command-player_3_id',
            'command',
            'player_3_id',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `training_id`
        $this->createIndex(
            'idx-command-training_id',
            'command',
            'training_id'
        );

        // add foreign key for table `training`
        $this->addForeignKey(
            'fk-command-training_id',
            'command',
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
            'fk-command-capitan_id',
            'command'
        );

        // drops index for column `capitan_id`
        $this->dropIndex(
            'idx-command-capitan_id',
            'command'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-command-player_1_id',
            'command'
        );

        // drops index for column `player_1_id`
        $this->dropIndex(
            'idx-command-player_1_id',
            'command'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-command-player_2_id',
            'command'
        );

        // drops index for column `player_2_id`
        $this->dropIndex(
            'idx-command-player_2_id',
            'command'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-command-player_3_id',
            'command'
        );

        // drops index for column `player_3_id`
        $this->dropIndex(
            'idx-command-player_3_id',
            'command'
        );

        // drops foreign key for table `training`
        $this->dropForeignKey(
            'fk-command-training_id',
            'command'
        );

        // drops index for column `training_id`
        $this->dropIndex(
            'idx-command-training_id',
            'command'
        );

        $this->dropTable('command');
    }
}
