<?php
use yii\db\Migration;

class m161217_084525_alter_table_alert extends Migration {

	public function up() {
		$this->alterColumn('alert', 'content', \yii\db\mysql\Schema::TYPE_TEXT . '(1000) NOT NULL');
	}

	public function down() {
		echo "m161217_084525_alter_table_alert cannot be reverted.\n";
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
