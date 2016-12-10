<?php

use yii\db\Migration;

class m161210_163824_update_customer extends Migration
{
    public function up()
    {
        $this->addColumn('customer', 'last_parent_id', \yii\db\mysql\Schema::TYPE_INTEGER . ' NULL');
        $this->addForeignKey('fk_customer_last_parent_id', '{{%customer}}', 'last_parent_id', 'user', 'id', 'CASCADE', 'CASCADE');

    }

    public function down()
    {
        echo "m161210_163824_update_customer cannot be reverted.\n";

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
