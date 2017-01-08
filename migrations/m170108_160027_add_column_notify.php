<?php
use yii\db\Migration;

class m170108_160027_add_column_notify extends Migration {

	public function up() {
		$this->addColumn('notification', 'user_id', \yii\db\mysql\Schema::TYPE_INTEGER . ' NOT NULL');
		$this->addColumn('notification', 'status', \yii\db\mysql\Schema::TYPE_INTEGER . ' NULL DEFAULT "0"');
		$this->addForeignKey('noti_fk_user', 'notification', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
	}

	public function down() {
		echo "m170108_160027_add_column_notify cannot be reverted.\n";
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
