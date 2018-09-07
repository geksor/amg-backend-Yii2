<?php

use yii\db\Migration;

/**
 * Handles the creation of table `mixDrive`.
 * Has foreign keys to the tables:
 *
 * - `user`
 */
class m180903_134932_create_mixDrive_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('mixDrive', [
            'id' => $this->primaryKey(),
            'photo' => $this->string(),
            'user_id' => $this->integer(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-mixDrive-user_id',
            'mixDrive',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-mixDrive-user_id',
            'mixDrive',
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
            'fk-mixDrive-user_id',
            'mixDrive'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-mixDrive-user_id',
            'mixDrive'
        );

        $this->dropTable('mixDrive');
    }
}
