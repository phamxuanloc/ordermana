<?php
use yii\db\Migration;
use yii\db\mysql\Schema;

class m161228_092343_alter_product_history extends Migration {

	public function up() {
		$this->alterColumn('product_history', 'old_value', Schema::TYPE_INTEGER . '(11) NULL DEFAULT "0"');
		$this->addColumn('product_history', 'quantity', Schema::TYPE_INTEGER . '(11) NULL DEFAULT "1"');
		$this->addColumn('product_history', 'supplier', Schema::TYPE_STRING . ' NULL');
		$this->addColumn('product_history', 'bill_image', Schema::TYPE_STRING . ' NULL');
		$this->addColumn('product_history', 'bill_number', Schema::TYPE_STRING . ' NULL');
		$this->addColumn('product_history', 'order_number', Schema::TYPE_STRING . ' NULL');
		$this->addColumn('product_history', 'receiver', Schema::TYPE_STRING . ' NULL');
		$this->addColumn('product_history', 'deliver', Schema::TYPE_STRING . ' NULL');
		$this->addColumn('product_history', 'color', Schema::TYPE_STRING . ' NULL');
		$this->addColumn('product_history', 'weight', Schema::TYPE_INTEGER . ' NULL');
		$this->addColumn('product_history', 'unit', Schema::TYPE_STRING . ' NULL');
		$this->addColumn('product_history', 'price_tax', Schema::TYPE_FLOAT . ' NULL');
		$this->addColumn('product_history', 'status', Schema::TYPE_INTEGER . ' NOT NULL DEFAULT "0"');
		$this->addColumn('product_history', 'supplier_discount', Schema::TYPE_INTEGER . ' NOT NULL DEFAULT "0"');
		$this->addColumn('product_history', 'base_price', Schema::TYPE_FLOAT . ' NOT NULL');
	}

	public function down() {
		echo "m161228_092343_alter_product_history cannot be reverted.\n";
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
