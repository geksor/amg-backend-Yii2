<?php

use yii\db\Migration;

/**
 * Handles adding image to table `command`.
 */
class m180930_143107_add_image_column_to_command_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('command', 'image', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('command', 'image');
    }
}
