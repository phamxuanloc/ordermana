<?php
use yii\db\Migration;

class m161217_190540_add_column_order extends Migration {

	public function up() {
		$this->addColumn('order_customer', 'discount', \yii\db\mysql\Schema::TYPE_INTEGER . ' NULL DEFAULT "0"');
	}

	public function down() {
		echo "m161217_190540_add_column_order cannot be reverted.\n";
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
