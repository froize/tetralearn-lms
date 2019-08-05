<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%chapter_task}}`.
 */
class m190331_093908_create_chapter_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%chapter_task}}', [
            'id' => $this->primaryKey(),
            'task_id' =>$this->integer(),
            'chapter_id' => $this->integer(),
        ]);
        // create index for column 'task_id'
        $this->createIndex(
            'idx-chapter-task',
            'chapter_task',
            'task_id'
        );

        //add foreign key for table chapter_task
        $this->addForeignKey(
            'fk-chapter-task',
            'chapter_task',
            'task_id',
            'task',
            'id',
            'CASCADE'
        );

        // create index for column 'chapter_id'
        $this->createIndex(
            'idx-task-chapter',
            'chapter_task',
            'chapter_id'
        );

        //add foreign key for table chapter_task
        $this->addForeignKey(
            'fk-task-chapter',
            'chapter_task',
            'chapter_id',
            'chapter',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%chapter_task}}');
    }
}
