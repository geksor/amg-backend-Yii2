<?php

use yii\db\Migration;

/**
 * Handles the creation of table `command_XClassDriveQuestion`.
 * Has foreign keys to the tables:
 *
 * - `command`
 * - `XClassDriveQuestion`
 */
class m180928_141036_create_junction_table_for_command_and_XClassDriveQuestion_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('command_XClassDriveQuestion', [
            'command_id' => $this->integer(),
            'XClassDriveQuestion_id' => $this->integer(),
            'PRIMARY KEY(command_id, XClassDriveQuestion_id)',
        ]);

        // creates index for column `command_id`
        $this->createIndex(
            'idx-command_XClassDriveQuestion-command_id',
            'command_XClassDriveQuestion',
            'command_id'
        );

        // add foreign key for table `command`
        $this->addForeignKey(
            'fk-command_XClassDriveQuestion-command_id',
            'command_XClassDriveQuestion',
            'command_id',
            'command',
            'id',
            'CASCADE'
        );

        // creates index for column `XClassDriveQuestion_id`
        $this->createIndex(
            'idx-command_XClassDriveQuestion-XClassDriveQuestion_id',
            'command_XClassDriveQuestion',
            'XClassDriveQuestion_id'
        );

        // add foreign key for table `XClassDriveQuestion`
        $this->addForeignKey(
            'fk-command_XClassDriveQuestion-XClassDriveQuestion_id',
            'command_XClassDriveQuestion',
            'XClassDriveQuestion_id',
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
        // drops foreign key for table `command`
        $this->dropForeignKey(
            'fk-command_XClassDriveQuestion-command_id',
            'command_XClassDriveQuestion'
        );

        // drops index for column `command_id`
        $this->dropIndex(
            'idx-command_XClassDriveQuestion-command_id',
            'command_XClassDriveQuestion'
        );

        // drops foreign key for table `XClassDriveQuestion`
        $this->dropForeignKey(
            'fk-command_XClassDriveQuestion-XClassDriveQuestion_id',
            'command_XClassDriveQuestion'
        );

        // drops index for column `XClassDriveQuestion_id`
        $this->dropIndex(
            'idx-command_XClassDriveQuestion-XClassDriveQuestion_id',
            'command_XClassDriveQuestion'
        );

        $this->dropTable('command_XClassDriveQuestion');
    }
}
