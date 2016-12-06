<?php
use yii\db\Migration;

class m161206_082148_drop_unique extends Migration {

	public function up() {
		$this->dropIndex('user_unique_email', 'user');
	}

	public function down() {
		echo "m161206_082148_drop_unique cannot be reverted.\n";
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
