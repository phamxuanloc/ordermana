<?php
use yii\db\Migration;
use yii\db\mysql\Schema;

class m161126_145241_add_column_category extends Migration {

	public function safeUp() {
		$this->addColumn('category', 'name', Schema::TYPE_STRING . ' NOT NULL');
	}

	public function safeDown() {
		echo "m161126_145241_add_column_category cannot be reverted.\n";
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
