<?php
use yii\db\Migration;

class m161126_154814_alter_product extends Migration {

	public function up() {
		$this->alterColumn('product', 'supplier_discount', \yii\db\mysql\Schema::TYPE_INTEGER . ' NULL DEFAULT "0"');
	}

	public function down() {
		echo "m161126_154814_alter_product cannot be reverted.\n";
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
