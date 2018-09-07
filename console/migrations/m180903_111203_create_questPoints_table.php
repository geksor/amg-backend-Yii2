<?php

use yii\db\Migration;

/**
 * Handles the creation of table `questPoints`.
 */
class m180903_111203_create_questPoints_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('questPoints', [
            'id' => $this->primaryKey(),
            'amgStatic' => $this->integer()->defaultValue(0),
            'mixStatic' => $this->integer()->defaultValue(0),
            'mbux' => $this->integer()->defaultValue(0),
            'xClassDrive' => $this->integer()->defaultValue(0),
            'amgDrive' => $this->integer()->defaultValue(0),
            'intelligent' => $this->integer()->defaultValue(0),
            'mixDrive' => $this->integer()->defaultValue(0),
            'xClassLine' => $this->integer()->defaultValue(0),
            'quizItem' => $this->integer()->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('questPoints');
    }
}
