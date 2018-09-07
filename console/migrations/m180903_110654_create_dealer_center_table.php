<?php

use yii\db\Migration;

/**
 * Handles the creation of table `dealer_center`.
 */
class m180903_110654_create_dealer_center_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('dealer_center', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('dealer_center');
    }
}
