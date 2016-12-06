<?php
use yii\db\Migration;

class m161206_085604_add_columns_to_customer extends Migration {

	public function up() {
		$this->addColumn('customer', 'point', \yii\db\mysql\Schema::TYPE_INTEGER . ' NULL DEFAULT "0"');
		$this->addColumn('customer', 'parent_id', \yii\db\mysql\Schema::TYPE_INTEGER . ' NULL DEFAULT "0"');
		$this->addColumn('customer', 'is_move', \yii\db\mysql\Schema::TYPE_INTEGER . ' NULL DEFAULT "0"');
		$this->addColumn('customer', 'link_fb', \yii\db\mysql\Schema::TYPE_STRING . '(255) NULL');
		$this->addColumn('customer', 'sale', \yii\db\mysql\Schema::TYPE_STRING . ' NULL');
		$this->addColumn('customer', 'note', \yii\db\mysql\Schema::TYPE_TEXT . ' NULL');
		$this->addColumn('customer', 'is_call', \yii\db\mysql\Schema::TYPE_STRING . ' NULL DEFAULT "0"');
		$this->alterColumn('provider', 'payment', \yii\db\mysql\Schema::TYPE_STRING . ' NULL');
	}

	public function down() {
		echo "m161206_085604_add_columns_to_customer cannot be reverted.\n";
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
