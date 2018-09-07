<?php

use yii\db\Migration;

/**
 * Handles the creation of table `mbux_test`.
 */
class m180903_134425_create_mbux_test_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('mbux_test', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('mbux_test');
    }
}
