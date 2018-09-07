<?php

use yii\db\Migration;

/**
 * Handles the creation of table `training`.
 */
class m180903_110712_create_timetable_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('timetable', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'startTime' => $this->string(),
            'stopTime' => $this->string(),
            'weekday' => $this->integer(1),
            'trainingDay' => $this->integer(1),
            'group' => $this->integer(1),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('timetable');
    }
}
