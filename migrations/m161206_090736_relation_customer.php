<?php
use yii\db\Migration;

class m161206_090736_relation_customer extends Migration {

	public function up() {
		$this->addForeignKey('fk_customer_parent_id', '{{%customer}}', 'parent_id', 'user', 'id', 'CASCADE', 'CASCADE');
		$this->addColumn('customer', 'call_by', \yii\db\mysql\Schema::TYPE_STRING . ' NULL');
		$this->addColumn('customer', 'call_at', \yii\db\mysql\Schema::TYPE_DATETIME . ' NULL');
	}

	public function down() {
		echo "m161206_090736_relation_customer cannot be reverted.\n";
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
