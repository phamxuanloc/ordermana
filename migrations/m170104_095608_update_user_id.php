<?php
use yii\db\Migration;

class m170104_095608_update_user_id extends Migration {

	public function up() {
		$this->addColumn('customer', 'update_user', \yii\db\mysql\Schema::TYPE_STRING . ' NULL');
	}

	public function down() {
		echo "m170104_095608_update_user_id cannot be reverted.\n";
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
