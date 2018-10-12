<?php

use yii\db\Migration;

/**
 * Handles the creation of table `photoReport`.
 */
class m181011_064957_create_photoReport_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('photoReport', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'video' => $this->text(),
            'videoTitle' => $this->string(),
            'isVideoLoad' => $this->integer(1)->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('photoReport');
    }
}
