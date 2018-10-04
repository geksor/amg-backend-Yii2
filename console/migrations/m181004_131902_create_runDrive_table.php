<?php

use yii\db\Migration;

/**
 * Handles the creation of table `runDrive`.
 */
class m181004_131902_create_runDrive_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('runDrive', [
            'id' => $this->primaryKey(),
            'training_id' => $this->integer(),
            'group' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('runDrive');
    }
}
