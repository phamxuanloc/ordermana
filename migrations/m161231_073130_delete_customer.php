<?php

use yii\db\Migration;

class m161231_073130_delete_customer extends Migration
{
    public function up()
    {
	    $this->delete('customer');
    }

    public function down()
    {
        echo "m161231_073130_delete_customer cannot be reverted.\n";

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
