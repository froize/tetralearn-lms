<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%dialog}}`.
 */
class m190507_102653_create_dialog_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%dialog}}', [
            'id' => $this->primaryKey(),
            'tutor_id' => $this->integer(),
            'student_id' => $this->integer(),
        ]);
        // create index for column
        $this->createIndex(
            'idx-dialog-tutor',
            'dialog',
            'tutor_id'
        );

        //add foreign key for table
        $this->addForeignKey(
            'fk-dialog-tutor',
            'dialog',
            'tutor_id',
            'user',
            'id',
            'CASCADE'
        );
        // create index for column
        $this->createIndex(
            'idx-dialog-student',
            'dialog',
            'tutor_id'
        );

        //add foreign key for table
        $this->addForeignKey(
            'fk-dialog-student',
            'dialog',
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
        $this->dropTable('{{%dialog}}');
    }
}
