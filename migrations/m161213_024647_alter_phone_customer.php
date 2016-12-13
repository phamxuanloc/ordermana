<?php
use yii\db\Migration;

class m161213_024647_alter_phone_customer extends Migration {

	public function up() {
		$this->alterColumn('customer', 'phone', \yii\db\mysql\Schema::TYPE_STRING . ' NOT NULL');
	}

	public function down() {
		echo "m161213_024647_alter_phone_customer cannot be reverted.\n";
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
