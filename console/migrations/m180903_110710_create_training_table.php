<?php

use yii\db\Migration;

/**
 * Handles the creation of table `training`.
 */
class m180903_110710_create_training_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('training', [
            'id' => $this->primaryKey(),
            'date' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('training');
    }
}
