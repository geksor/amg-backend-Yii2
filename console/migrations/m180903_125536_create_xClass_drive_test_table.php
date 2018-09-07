<?php

use yii\db\Migration;

/**
 * Handles the creation of table `xClass_drive_test`.
 * Has foreign keys to the tables:
 *
 * - `command`
 */
class m180903_125536_create_xClass_drive_test_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('xClass_drive_test', [
            'id' => $this->primaryKey(),
            'point_1_img' => $this->string(),
            'point_2_img' => $this->string(),
            'point_3_img' => $this->string(),
            'point_1_link' => $this->string(),
            'point_2_link' => $this->string(),
            'point_3_link' => $this->string(),
            'point_1_desc' => $this->string(),
            'point_2_desc' => $this->string(),
            'point_3_desc' => $this->string(),
            'command_id' => $this->integer(),
        ]);

        // creates index for column `command_id`
        $this->createIndex(
            'idx-xClass_drive_test-command_id',
            'xClass_drive_test',
            'command_id'
        );

        // add foreign key for table `command`
        $this->addForeignKey(
            'fk-xClass_drive_test-command_id',
            'xClass_drive_test',
            'command_id',
            'command',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `command`
        $this->dropForeignKey(
            'fk-xClass_drive_test-command_id',
            'xClass_drive_test'
        );

        // drops index for column `command_id`
        $this->dropIndex(
            'idx-xClass_drive_test-command_id',
            'xClass_drive_test'
        );

        $this->dropTable('xClass_drive_test');
    }
}
