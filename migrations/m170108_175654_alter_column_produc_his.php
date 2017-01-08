<?php
use yii\db\Migration;

class m170108_175654_alter_column_produc_his extends Migration {

	public function up() {
		$this->alterColumn('product_history', 'supplier_discount', \yii\db\mysql\Schema::TYPE_INTEGER . ' NULL DEFAULT "0"');
	}

	public function down() {
		echo "m170108_175654_alter_column_produc_his cannot be reverted.\n";
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
