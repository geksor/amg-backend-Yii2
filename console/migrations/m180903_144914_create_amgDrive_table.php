<?php

use yii\db\Migration;

/**
 * Handles the creation of table `amgDrive`.
 * Has foreign keys to the tables:
 *
 * - `user`
 */
class m180903_144914_create_amgDrive_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('amgDrive', [
            'id' => $this->primaryKey(),
            'photo' => $this->string(),
            'user_id' => $this->integer(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-amgDrive-user_id',
            'amgDrive',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-amgDrive-user_id',
            'amgDrive',
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
            'fk-amgDrive-user_id',
            'amgDrive'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-amgDrive-user_id',
            'amgDrive'
        );

        $this->dropTable('amgDrive');
    }
}
