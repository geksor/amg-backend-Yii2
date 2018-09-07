<?php

use yii\db\Migration;

/**
 * Handles the creation of table `mixStatic`.
 */
class m180903_130841_create_mixStatic_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('mixStatic', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'image' => $this->string(),
            'rank' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('mixStatic');
    }
}
