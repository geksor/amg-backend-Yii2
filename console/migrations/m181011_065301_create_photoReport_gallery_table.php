<?php

use yii\db\Migration;

/**
 * Handles the creation of table `photoReport_gallery`.
 * Has foreign keys to the tables:
 *
 * - `photoReport`
 */
class m181011_065301_create_photoReport_gallery_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('photoReport_gallery', [
            'id' => $this->primaryKey(),
            'type' => $this->string(),
            'ownerId' => $this->integer()->notNull(),
            'rank' => $this->integer()->notNull()->defaultValue(0),
            'name' => $this->string(),
            'description' => $this->text(),
            'rating' => $this->integer(),
            'voteCount' => $this->integer(),
        ]);

        // creates index for column `ownerId`
        $this->createIndex(
            'idx-photoReport_gallery-ownerId',
            'photoReport_gallery',
            'ownerId'
        );

        // add foreign key for table `photoReport`
        $this->addForeignKey(
            'fk-photoReport_gallery-ownerId',
            'photoReport_gallery',
            'ownerId',
            'photoReport',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `photoReport`
        $this->dropForeignKey(
            'fk-photoReport_gallery-ownerId',
            'photoReport_gallery'
        );

        // drops index for column `ownerId`
        $this->dropIndex(
            'idx-photoReport_gallery-ownerId',
            'photoReport_gallery'
        );

        $this->dropTable('photoReport_gallery');
    }
}
