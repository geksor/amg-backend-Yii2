<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_gallery_image`.
 * Has foreign keys to the tables:
 *
 * - `user`
 * - `gallery_image`
 */
class m180920_170334_create_junction_table_for_user_and_gallery_image_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user_gallery_image', [
            'user_id' => $this->integer(),
            'gallery_image_id' => $this->integer(),
            'PRIMARY KEY(user_id, gallery_image_id)',
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-user_gallery_image-user_id',
            'user_gallery_image',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-user_gallery_image-user_id',
            'user_gallery_image',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `gallery_image_id`
        $this->createIndex(
            'idx-user_gallery_image-gallery_image_id',
            'user_gallery_image',
            'gallery_image_id'
        );

        // add foreign key for table `gallery_image`
        $this->addForeignKey(
            'fk-user_gallery_image-gallery_image_id',
            'user_gallery_image',
            'gallery_image_id',
            'gallery_image',
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
            'fk-user_gallery_image-user_id',
            'user_gallery_image'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-user_gallery_image-user_id',
            'user_gallery_image'
        );

        // drops foreign key for table `gallery_image`
        $this->dropForeignKey(
            'fk-user_gallery_image-gallery_image_id',
            'user_gallery_image'
        );

        // drops index for column `gallery_image_id`
        $this->dropIndex(
            'idx-user_gallery_image-gallery_image_id',
            'user_gallery_image'
        );

        $this->dropTable('user_gallery_image');
    }
}
