<?php
use yii\db\Migration;

class m170104_083707_alter_created_date extends Migration {

	public function up() {
		$this->alterColumn('alert', 'created_date', \yii\db\mysql\Schema::TYPE_TIMESTAMP . ' DEFAULT CURRENT_TIMESTAMP');
		$this->alterColumn('customer', 'created_date', \yii\db\mysql\Schema::TYPE_TIMESTAMP . ' DEFAULT CURRENT_TIMESTAMP');
		$this->alterColumn('order', 'created_date', \yii\db\mysql\Schema::TYPE_TIMESTAMP . ' DEFAULT CURRENT_TIMESTAMP');
		$this->alterColumn('order_customer', 'created_date', \yii\db\mysql\Schema::TYPE_TIMESTAMP . ' DEFAULT CURRENT_TIMESTAMP');
		$this->alterColumn('product', 'created_date', \yii\db\mysql\Schema::TYPE_TIMESTAMP . ' DEFAULT CURRENT_TIMESTAMP');
		$this->alterColumn('point', 'created_date', \yii\db\mysql\Schema::TYPE_TIMESTAMP . ' DEFAULT CURRENT_TIMESTAMP');
		$this->alterColumn('product_history', 'created_date', \yii\db\mysql\Schema::TYPE_TIMESTAMP . ' DEFAULT CURRENT_TIMESTAMP');
		$this->alterColumn('provider', 'created_date', \yii\db\mysql\Schema::TYPE_TIMESTAMP . ' DEFAULT CURRENT_TIMESTAMP');
		$this->alterColumn('user_stock', 'created_date', \yii\db\mysql\Schema::TYPE_TIMESTAMP . ' DEFAULT CURRENT_TIMESTAMP');
	}

	public function down() {
		echo "m170104_083707_alter_created_date cannot be reverted.\n";
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
