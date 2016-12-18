<?php
use yii\db\Migration;

class m161218_175753_add_product_history extends Migration {

	public function up() {
		$this->addColumn('product_history', 'product_id', \yii\db\Schema::TYPE_INTEGER);
		$this->addForeignKey('history_fk_product', 'product_history', 'product_id', 'product', 'id', 'CASCADE', 'CASCADE');
		$this->alterColumn('product_history', 'code', \yii\db\mysql\Schema::TYPE_STRING . '(255)');
	}

	public function down() {
		echo "m161218_175753_add_product_history cannot be reverted.\n";
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
