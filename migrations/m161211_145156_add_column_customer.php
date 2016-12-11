<?php
use yii\db\Migration;

class m161211_145156_add_column_customer extends Migration {

	public function up() {
		$this->addColumn('customer', 'product', \yii\db\mysql\Schema::TYPE_TEXT . ' NULL');
		$this->addColumn('customer', 'source', \yii\db\mysql\Schema::TYPE_STRING . ' NULL');
	}

	public function down() {
		echo "m161211_145156_add_column_customer cannot be reverted.\n";
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
