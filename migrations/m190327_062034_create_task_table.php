<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%task}}`.
 */
class m190327_062034_create_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%task}}', [
            'id' => $this->primaryKey(),
            'name' =>$this->string(),
            'text' => $this->text(),
            'duration' => $this->integer(),
            'add_date' => $this->dateTime(),
            'start_date' => $this->dateTime(),
            'end_date' => $this->dateTime(),
            'active' => $this->boolean(),
            'is_test' => $this->boolean(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%task}}');
    }
}
