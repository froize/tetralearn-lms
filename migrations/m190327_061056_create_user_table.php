<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m190327_061056_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'surname' => $this->string(),
            'email' => $this->string(),
            'password' => $this->string(),
            'reg_date' => $this->dateTime(),
            'is_tutor' => $this->boolean(),
            'group_id' => $this->integer(),
        ]);
        // create index for column 'group_id'
        $this->createIndex(
            'idx-user-group',
            'user',
            'group_id'
        );

        //add foreign key for table group
        $this->addForeignKey(
            'fk-user-group',
            'user',
            'group_id',
            'group',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
