<?php
use yii\db\Migration;

class m161130_102208_add_column_order_item extends Migration {

	public function up() {
		$this->addColumn('customer_item', 'status', \yii\db\mysql\Schema::TYPE_INTEGER . ' NULL');
		$this->addColumn('order_item', 'status', \yii\db\mysql\Schema::TYPE_INTEGER . ' NULL');
	}

	public function down() {
		echo "m161130_102208_add_column_order_item cannot be reverted.\n";
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
