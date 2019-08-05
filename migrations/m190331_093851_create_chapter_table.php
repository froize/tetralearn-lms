<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%chapter}}`.
 */
class m190331_093851_create_chapter_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%chapter}}', [
            'id' => $this->primaryKey(),
            'name' =>$this->string(),
            'course_id' => $this->integer(),
        ]);

        // create index for column 'course_id'
        $this->createIndex(
            'idx-chapter-course',
            'chapter',
            'course_id'
        );

        //add foreign key for table chapter
        $this->addForeignKey(
            'fk-chapter-course',
            'chapter',
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
        $this->dropTable('{{%chapter}}');
    }
}
