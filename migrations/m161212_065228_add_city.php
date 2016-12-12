<?php

use yii\db\Migration;

class m161212_065228_add_city extends Migration
{
    public function up()
    {
        $this->insert('{{%city}}', ['id'     => '64',
                                    'name'   => 'Malaysia',
                                    'status' => '1',
        ]);
    }

    public function down()
    {
        echo "m161212_065228_add_city cannot be reverted.\n";

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
