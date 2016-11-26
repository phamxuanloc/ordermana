<?php
use yii\db\Migration;
use yii\db\mysql\Schema;

class m161126_141246_alter_table_product_category extends Migration {

	public function safeUp() {
		$this->renameColumn('category', 'type', 'status');
		$this->delete('category', ['id' => 1]);
		$this->addColumn('product', 'representative_sale', Schema::TYPE_FLOAT . ' NOT NULL');
		$this->addColumn('product', 'big_agent_sale', Schema::TYPE_FLOAT . ' NOT NULL');
	}

	public function safeDown() {
		echo "cannot be reverted.\n";
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
