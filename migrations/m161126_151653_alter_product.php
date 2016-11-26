<?php
use yii\db\Migration;

class m161126_151653_alter_product extends Migration {

	public function up() {
		$this->alterColumn('product', 'description', \yii\db\mysql\Schema::TYPE_TEXT . ' NULL');
	}

	public function down() {
		echo "m161126_151653_alter_product cannot be reverted.\n";
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
