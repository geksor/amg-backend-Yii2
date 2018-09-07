<?php

use yii\db\Migration;

/**
 * Handles the creation of table `xClass_line_test`.
 */
class m180903_135554_create_xClass_line_test_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('xClass_line_test', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('xClass_line_test');
    }
}
