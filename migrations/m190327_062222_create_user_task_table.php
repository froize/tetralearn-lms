<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_task}}`.
 */
class m190327_062222_create_user_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_task}}', [
            'id' => $this->primaryKey(),
            'task_id' =>$this->integer(),
            'student_id' =>$this->integer(),
            'grade' =>$this->integer(),
            'date' => $this->dateTime(),
            'rss' => $this->boolean(),
        ]);

        // create index for column 'task_id'
        $this->createIndex(
            'idx-user-task',
            'user_task',
            'task_id'
        );

        //add foreign key for table task
        $this->addForeignKey(
            'fk-user-task',
            'user_task',
            'task_id',
            'task',
            'id',
            'CASCADE'
        );

        // create index for column 'student_id'
        $this->createIndex(
            'idx-task-student',
            'user_task',
            'student_id'
        );

        //add foreign key for table user
        $this->addForeignKey(
            'fk-task-student',
            'user_task',
            'student_id',
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
        $this->dropTable('{{%user_task}}');
    }
}
