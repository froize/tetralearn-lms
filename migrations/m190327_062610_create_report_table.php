<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%report}}`.
 */
class m190327_062610_create_report_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%report}}', [
            'id' => $this->primaryKey(),
            'group_id'=>$this->integer(),
            'title'=>$this->string(),
        ]);
        $this->createIndex(
            'idx-report-group',
            'report',
            'group_id'
        );

        //add foreign key for table group
        $this->addForeignKey(
            'fk-report-group',
            'report',
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
        $this->dropTable('{{%report}}');
    }
}
