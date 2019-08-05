<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%course_curator}}`.
 */
class m190401_160315_create_course_curator_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%course_curator}}', [
            'id' => $this->primaryKey(),
            'curator_id' => $this->integer(),
            'course_id' => $this->integer(),
        ]);

        // create index for column 'curator_id'
        $this->createIndex(
            'idx-course-curator',
            'course_curator',
            'curator_id'
        );

        //add foreign key for table user
        $this->addForeignKey(
            'fk-course-curator',
            'course_curator',
            'curator_id',
            'user',
            'id',
            'CASCADE'
        );

        // create index for column 'course_id'
        $this->createIndex(
            'idx-curator-course',
            'course_curator',
            'course_id'
        );

        //add foreign key for table
        $this->addForeignKey(
            'fk-curator-course',
            'course_curator',
            'course_id',
            'course',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%course_curator}}');
    }
}
