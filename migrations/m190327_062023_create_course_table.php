<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%course}}`.
 */
class m190327_062023_create_course_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%course}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'desc' => $this->text(),
            'rating' => $this->float(),
            'start_date' => $this->dateTime(),
            'end_date' => $this->dateTime(),
            'active' => $this->boolean(),
            'tutor_id' => $this->integer(),
            'private_course' => $this->boolean(),
        ]);

        // create index for column 'tutor_id'
        $this->createIndex(
            'idx-course-tutor',
            'course',
            'tutor_id'
        );

        //add foreign key for table user
        $this->addForeignKey(
            'fk-course-tutor',
            'course',
            'tutor_id',
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
        $this->dropTable('{{%course}}');
    }
}
