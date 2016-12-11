<?php
use yii\db\Migration;

class m161211_162926_add_column_customer extends Migration {

	public function up() {
		$this->addColumn('customer', 'created_date', \yii\db\mysql\Schema::TYPE_TIMESTAMP);
	}

	public function down() {
		echo "m161211_162926_add_column_customer cannot be reverted.\n";
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
