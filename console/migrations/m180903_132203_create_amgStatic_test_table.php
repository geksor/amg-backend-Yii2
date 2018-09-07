<?php

use yii\db\Migration;

/**
 * Handles the creation of table `amgStatic_test`.
 */
class m180903_132203_create_amgStatic_test_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('amgStatic_test', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('amgStatic_test');
    }
}
