<?php

use yii\db\Migration;

/**
 * Handles the creation of table `mixStatic_user`.
 * Has foreign keys to the tables:
 *
 * - `mixStatic`
 * - `user`
 */
class m180920_143438_create_junction_table_for_mixStatic_and_user_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('mixStatic_user', [
            'mixStatic_id' => $this->integer(),
            'user_id' => $this->integer(),
            'PRIMARY KEY(mixStatic_id, user_id)',
        ]);

        // creates index for column `mixStatic_id`
        $this->createIndex(
            'idx-mixStatic_user-mixStatic_id',
            'mixStatic_user',
            'mixStatic_id'
        );

        // add foreign key for table `mixStatic`
        $this->addForeignKey(
            'fk-mixStatic_user-mixStatic_id',
            'mixStatic_user',
            'mixStatic_id',
            'mixStatic',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            'idx-mixStatic_user-user_id',
            'mixStatic_user',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-mixStatic_user-user_id',
            'mixStatic_user',
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
        // drops foreign key for table `mixStatic`
        $this->dropForeignKey(
            'fk-mixStatic_user-mixStatic_id',
            'mixStatic_user'
        );

        // drops index for column `mixStatic_id`
        $this->dropIndex(
            'idx-mixStatic_user-mixStatic_id',
            'mixStatic_user'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-mixStatic_user-user_id',
            'mixStatic_user'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-mixStatic_user-user_id',
            'mixStatic_user'
        );

        $this->dropTable('mixStatic_user');
    }
}
