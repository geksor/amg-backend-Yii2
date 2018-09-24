<?php

use yii\db\Migration;

/**
 * Handles the creation of table `endQuest`.
 * Has foreign keys to the tables:
 *
 * - `user`
 */
class m180924_055000_create_endQuest_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('endQuest', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'xClassDrive' => $this->integer(1)->defaultValue(0),
            'mixStatic' => $this->integer(1)->defaultValue(0),
            'amgStatic' => $this->integer(1)->defaultValue(0),
            'mbux' => $this->integer(1)->defaultValue(0),
            'amgDrive' => $this->integer(1)->defaultValue(0),
            'mixDrive' => $this->integer(1)->defaultValue(0),
            'xClassLine' => $this->integer(1)->defaultValue(0),
            'quiz' => $this->integer(1)->defaultValue(0),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-endQuest-user_id',
            'endQuest',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-endQuest-user_id',
            'endQuest',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-endQuest-user_id',
            'endQuest'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-endQuest-user_id',
            'endQuest'
        );

        $this->dropTable('endQuest');
    }
}
