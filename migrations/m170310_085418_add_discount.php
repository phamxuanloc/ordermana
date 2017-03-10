<?php
use yii\db\Migration;

class m170310_085418_add_discount extends Migration {

	public function up() {
		$this->addColumn('order_item', 'discount', \yii\db\mysql\Schema::TYPE_DOUBLE . ' NULL DEFAULT "0"');
		$this->addColumn('center_item', 'discount', \yii\db\mysql\Schema::TYPE_DOUBLE . ' NULL DEFAULT "0"');
		$this->addColumn('customer_item', 'discount', \yii\db\mysql\Schema::TYPE_DOUBLE . ' NULL DEFAULT "0"');
	}

	public function down() {
		echo "m170310_085418_add_discount cannot be reverted.\n";
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
