<?php

use yii\db\Migration;

/**
 * Handles the creation of table `xClassDriveCommand`.
 * Has foreign keys to the tables:
 *
 * - `user`
 * - `user`
 * - `user`
 * - `user`
 */
class m180903_112306_create_command_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('command', [
            'id' => $this->primaryKey(),
            'commandNumber' => $this->integer(),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropTable('command');
    }
}
