<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_course}}`.
 */
class m190331_140439_create_user_course_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_course}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'course_id' => $this->integer(),
        ]);

        // create index for column 'user_id'
        $this->createIndex(
            'idx-course-user',
            'user_course',
            'user_id'
        );

        //add foreign key for table user_course
        $this->addForeignKey(
            'fk-course-user',
            'user_course',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        // create index for column 'course_id'
        $this->createIndex(
            'idx-user-course',
            'user_course',
            'course_id'
        );

        //add foreign key for table user_course
        $this->addForeignKey(
            'fk-user-course',
            'user_course',
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
        $this->dropTable('{{%user_course}}');
    }
}
