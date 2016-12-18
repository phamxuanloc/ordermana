<?php
use yii\db\Migration;

class m161218_101825_add_column_customer extends Migration {

	public function up() {
		$this->addColumn('customer_item', 'customer_id', \yii\db\mysql\Schema::TYPE_INTEGER);
		$this->addForeignKey('customer_item_fk_user', 'customer_item', 'customer_id', 'customer', 'id', 'CASCADE', 'CASCADE');
	}

	public function down() {
		echo "m161218_101825_add_column_customer cannot be reverted.\n";
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
