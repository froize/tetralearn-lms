<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%invitations}}`.
 */
class m190423_165828_create_invitations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%invitation}}', [
            'id' => $this->primaryKey(),
            'course_id' => $this->integer(),
            'user_id' => $this->integer(),
            'title' => $this->string(),
            'text' => $this->text(),
        ]);
        // create index for column 'group_id'
        $this->createIndex(
            'idx-invitation-course',
            'invitation',
            'course_id'
        );

        //add foreign key for table group
        $this->addForeignKey(
            'fk-invitation-course',
            'invitation',
            'course_id',
            'course',
            'id',
            'CASCADE'
        );
        // create index for column 'group_id'
        $this->createIndex(
            'idx-invitation-user',
            'invitation',
            'user_id'
        );

        //add foreign key for table group
        $this->addForeignKey(
            'fk-invitation-user',
            'invitation',
            'user_id',
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
        $this->dropTable('{{%invitations}}');
    }
}
