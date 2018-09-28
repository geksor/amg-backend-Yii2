<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m180903_134913_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'surname' => $this->string(),
            'first_name' => $this->string(),
            'last_name' => $this->string(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'role' => $this->smallInteger()->notNull()->defaultValue(4),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),

            'group' => $this->integer(1),
            'training_id' => $this->integer(),
            'dealer_center_id' => $this->integer(),

            'amgStatic' => $this->integer()->defaultValue(0),
            'mixStatic' => $this->integer()->defaultValue(0),
            'mbux' => $this->integer()->defaultValue(0),
            'xClassDrive' => $this->integer()->defaultValue(0),
            'amgDrive' => $this->integer()->defaultValue(0),
            'intelligent' => $this->integer()->defaultValue(0),
            'mixDrive' => $this->integer()->defaultValue(0),
            'xClassLine' => $this->integer()->defaultValue(0),
            'quiz' => $this->integer()->defaultValue(0),
            'moderatorPoints' => $this->integer()->defaultValue(0),

            'totalPoint' => $this->integer()->defaultValue(0),
            'command_id' => $this->integer(),
        ]);

        // creates index for column `training_id`
        $this->createIndex(
            'idx-user-training_id',
            'user',
            'training_id'
        );

        // add foreign key for table `training`
        $this->addForeignKey(
            'fk-user-training_id',
            'user',
            'training_id',
            'training',
            'id',
            'SET NULL'
        );

        // creates index for column `dealer_center_id`
        $this->createIndex(
            'idx-user-dealer_center_id',
            'user',
            'dealer_center_id'
        );

        // add foreign key for table `dealer_center`
        $this->addForeignKey(
            'fk-user-dealer_center_id',
            'user',
            'dealer_center_id',
            'dealer_center',
            'id',
            'SET NULL'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        // drops foreign key for table `dealer_center`
        $this->dropForeignKey(
            'fk-user-dealer_center_id',
            'user'
        );

        // drops index for column `dealer_center_id`
        $this->dropIndex(
            'idx-user-dealer_center_id',
            'user'
        );

        // drops foreign key for table `training`
        $this->dropForeignKey(
            'fk-user-training_id',
            'user'
        );

        // drops index for column `training_id`
        $this->dropIndex(
            'idx-user-training_id',
            'user'
        );

        $this->dropTable('user');
    }
}
