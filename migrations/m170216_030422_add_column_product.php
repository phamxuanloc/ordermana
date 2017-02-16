<?php
use yii\db\Migration;
use yii\db\mssql\Schema;

class m170216_030422_add_column_product extends Migration {

	public function up() {
		$this->addColumn('product', 'center_sale', Schema::TYPE_FLOAT . ' NOT NULL');

	}

	public function down() {
		echo "m170216_030422_add_column_product cannot be reverted.\n";
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
