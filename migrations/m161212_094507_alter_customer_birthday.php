<?php
use yii\db\Migration;

class m161212_094507_alter_customer_birthday extends Migration {

	public function up() {
		$this->alterColumn('customer', 'city_id', \yii\db\mysql\Schema::TYPE_STRING . ' NULL');
	}

	public function down() {
		echo "m161212_094507_alter_customer_birthday cannot be reverted.\n";
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
