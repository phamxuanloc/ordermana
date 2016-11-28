<?php
use yii\db\Migration;

class m161128_110045_alter_product_code extends Migration {

	public function up() {
		$this->alterColumn('product', 'code', \yii\db\mysql\Schema::TYPE_STRING . '(255)');
	}

	public function down() {
		echo "m161128_110045_alter_product_code cannot be reverted.\n";
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
