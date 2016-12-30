<?php
use yii\db\Migration;

class m161230_064627_truncate_customer extends Migration {

	public function up() {
		$this->delete('customer');
	}

	public function down() {
		echo "m161230_064627_truncate_customer cannot be reverted.\n";
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
