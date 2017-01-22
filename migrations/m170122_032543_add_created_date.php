<?php
use yii\db\Migration;

class m170122_032543_add_created_date extends Migration {

	public function up() {
		$this->addColumn('customer_item', 'created_date', \yii\db\mysql\Schema::TYPE_TIMESTAMP . ' DEFAULT CURRENT_TIMESTAMP');
	}

	public function down() {
		echo "m170122_032543_add_created_date cannot be reverted.\n";
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
