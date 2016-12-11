<?php
use yii\db\Migration;

class m161211_174415_add_column_user_customer extends Migration {

	public function up() {
		$this->addColumn('user', 'birthday', \yii\db\mysql\Schema::TYPE_DATETIME . ' NOT NULL');
		$this->addColumn('customer', 'birthday', \yii\db\mysql\Schema::TYPE_DATETIME . ' NULL');
	}

	public function down() {
		echo "m161211_174415_add_column_user_customer cannot be reverted.\n";
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
