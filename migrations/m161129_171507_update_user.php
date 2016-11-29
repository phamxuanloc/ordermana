<?php
use yii\db\Migration;

class m161129_171507_update_user extends Migration {

	public function up() {
		$this->alterColumn('user', 'email', \yii\db\mysql\Schema::TYPE_STRING . '(255) NULL');
		$this->addColumn('user', 'phone', \yii\db\mysql\Schema::TYPE_STRING . '(255) NOT NULL');
	}

	public function down() {
		echo "m161129_171507_update_user cannot be reverted.\n";
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
