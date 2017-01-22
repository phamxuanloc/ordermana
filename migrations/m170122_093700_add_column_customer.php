<?php
use yii\db\Migration;

class m170122_093700_add_column_customer extends Migration {

	public function up() {
		$this->addColumn('customer', 'created_by', \yii\db\mysql\Schema::TYPE_INTEGER . ' NULL');
	}

	public function down() {
		echo "m170122_093700_add_column_customer cannot be reverted.\n";
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
