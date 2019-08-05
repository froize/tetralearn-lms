<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%lecture_task}}`.
 */
class m190331_093928_create_lecture_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%lecture_task}}', [
            'id' => $this->primaryKey(),
            'task_id' =>$this->integer(),
            'lecture_id' => $this->integer(),
        ]);

        // create index for column 'task_id'
        $this->createIndex(
            'idx-lecture-task',
            'lecture_task',
            'task_id'
        );

        //add foreign key for table chapter_task
        $this->addForeignKey(
            'fk-lecture-task',
            'lecture_task',
            'task_id',
            'task',
            'id',
            'CASCADE'
        );

        // create index for column 'chapter_id'
        $this->createIndex(
            'idx-task-lecture',
            'lecture_task',
            'lecture_id'
        );

        //add foreign key for table chapter_task
        $this->addForeignKey(
            'fk-task-lecture',
            'lecture_task',
            'lecture_id',
            'lecture',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%lecture_task}}');
    }
}
