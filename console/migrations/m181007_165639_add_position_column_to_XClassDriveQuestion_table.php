<?php

use yii\db\Migration;

/**
 * Handles adding position to table `XClassDriveQuestion`.
 */
class m181007_165639_add_position_column_to_XClassDriveQuestion_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('XClassDriveQuestion', 'answer_var_5', $this->string());
        $this->addColumn('XClassDriveQuestion', 'answer_var_6', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('XClassDriveQuestion', 'answer_var_6');
        $this->dropColumn('XClassDriveQuestion', 'answer_var_5');
    }
}
