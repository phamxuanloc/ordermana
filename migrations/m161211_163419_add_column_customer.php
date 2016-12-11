<?php
use yii\db\Migration;

class m161211_163419_add_column_customer extends Migration {

	public function up() {
		$this->addColumn('customer', 'id_number', \yii\db\mysql\Schema::TYPE_STRING . ' NULL');
		$this->alterColumn('user', 'id_number', \yii\db\mysql\Schema::TYPE_STRING . ' NOT NULL');
	}

	public function down() {
		echo "m161211_163419_add_column_customer cannot be reverted.\n";
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
