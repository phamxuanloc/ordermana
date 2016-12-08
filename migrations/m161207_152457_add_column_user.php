<?php
use yii\db\Migration;
use yii\db\mysql\Schema;

class m161207_152457_add_column_user extends Migration {

	public function up() {
		$this->addColumn('user', 'address', Schema::TYPE_STRING . ' NULL');
		$this->addColumn('user', 'id_number', Schema::TYPE_INTEGER . ' NULL');
	}

	public function down() {
		echo "m161207_152457_add_column_user cannot be reverted.\n";
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
