<?php
use yii\db\Migration;

class m161228_094359_alter_product_history extends Migration {

	public function up() {
		$this->addForeignKey('product_history_fk_product', 'product_history', 'product_id', 'product', 'id', 'CASCADE', 'CASCADE');
		$this->alterColumn('product_history', 'name', \yii\db\mysql\Schema::TYPE_STRING . '(255) NULL');
		$this->alterColumn('product_history', 'category_id', \yii\db\mysql\Schema::TYPE_INTEGER . '(11) NULL');
	}

	public function down() {
		echo "m161228_094359_alter_product_history cannot be reverted.\n";
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
