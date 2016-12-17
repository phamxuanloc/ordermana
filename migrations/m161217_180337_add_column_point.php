<?php
use yii\db\Migration;

class m161217_180337_add_column_point extends Migration {

	public function up() {
		$this->addColumn('point', 'discount', \yii\db\mysql\Schema::TYPE_INTEGER . ' NOT NULL');
	}

	public function down() {
		echo "m161217_180337_add_column_point cannot be reverted.\n";
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
