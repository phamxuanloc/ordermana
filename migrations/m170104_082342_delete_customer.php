<?php
use yii\db\Migration;

class m170104_082342_delete_customer extends Migration {

	public function up() {
		$this->delete('customer', 'created_date>=' . date('Y-m-d'));
	}

	public function down() {
		echo "m170104_082342_delete_customer cannot be reverted.\n";
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
