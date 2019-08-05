<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%course_group}}`.
 */
class m190401_142217_create_course_group_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%course_group}}', [
            'id' => $this->primaryKey(),
            'course_id' => $this->integer(),
            'group_id' => $this->integer(),
        ]);

        // create index for column 'course_id'
        $this->createIndex(
            'idx-group-course',
            'course_group',
            'course_id'
        );

        //add foreign key for table
        $this->addForeignKey(
            'fk-group-course',
            'course_group',
            'course_id',
            'course',
            'id',
            'CASCADE'
        );

        // create index for column 'group_id'
        $this->createIndex(
            'idx-course-group',
            'course_group',
            'group_id'
        );

        //add foreign key for table
        $this->addForeignKey(
            'fk-course-group',
            'course_group',
            'group_id',
            'group',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%course_group}}');
    }
}
