<?php

use yii\db\Migration;
use yii\db\mysql\Schema;

class m170107_031901_add_ava_noti extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable('notification', [
            'id' => Schema::TYPE_PK . '',
            'content' => Schema::TYPE_TEXT . ' NOT NULL',
            'url' => Schema::TYPE_STRING . ' NULL',
            'created_date' => Schema::TYPE_TIMESTAMP . ' DEFAULT CURRENT_TIMESTAMP'
        ], $tableOptions);
        $this->addColumn('user', 'avatar', Schema::TYPE_STRING . ' NULL');
        $this->addColumn('customer', 'avatar', Schema::TYPE_STRING . ' NULL');
    }

    public function down()
    {
        echo "m170107_031901_add_ava_noti cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
