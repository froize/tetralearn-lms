<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%answer}}`.
 */
class m190327_062235_create_answer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%answer}}', [
            'id' => $this->primaryKey(),
            'task_id'=> $this->integer(),
            'user_id'=>$this->integer(),
            'text' =>$this->text(),
            'datetime' => $this->dateTime(),
        ]);

        // create index for column 'task_id'
        $this->createIndex(
            'idx-answer-task',
            'answer',
            'task_id'
        );

        //add foreign key for table task
        $this->addForeignKey(
            'fk-answer-task',
            'answer',
            'task_id',
            'task',
            'id',
            'CASCADE'
        );

        // create index for column 'user_id'
        $this->createIndex(
            'idx-task-student',
            'answer',
            'student_id'
        );

        //add foreign key for table user
        $this->addForeignKey(
            'fk-task-student',
            'answer',
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
        $this->dropTable('{{%answer}}');
    }
}
