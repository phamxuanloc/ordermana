<?php
use yii\db\Migration;

class m161231_071556_alter_column_customer extends Migration {

	public function up() {
		$this->alterColumn('customer', 'name', \yii\db\mysql\Schema::TYPE_STRING . ' NULL');
		$this->alterColumn('customer', 'phone', \yii\db\mysql\Schema::TYPE_STRING . ' NULL');
	}

	public function down() {
		echo "m161231_071556_alter_column_customer cannot be reverted.\n";
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
