<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%lecture}}`.
 */
class m190331_093919_create_lecture_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%lecture}}', [
            'id' => $this->primaryKey(),
            'name' =>$this->string(),
            'text' =>$this->text(),
            'chapter_id' => $this->integer(),
        ]);

        // create index for column 'chapter_id'
        $this->createIndex(
            'idx-lecture-chapter',
            'lecture',
            'chapter_id'
        );

        //add foreign key for table chapter_task
        $this->addForeignKey(
            'fk-lecture-chapter',
            'lecture',
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
        $this->dropTable('{{%lecture}}');
    }
}
