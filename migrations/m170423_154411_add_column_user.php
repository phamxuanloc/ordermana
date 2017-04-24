<?php
use yii\db\Migration;

class m170423_154411_add_column_user extends Migration {

	public function up() {
		$this->addColumn('user', 'code', $this->string());
		$this->addColumn('user', 'code_number', $this->integer());
	}

	public function down() {
		echo "m170423_154411_add_column_user cannot be reverted.\n";
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
