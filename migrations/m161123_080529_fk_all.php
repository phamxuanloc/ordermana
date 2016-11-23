<?php
use yii\db\Migration;
use yii\db\mysql\Schema;

class m161123_080529_fk_all extends Migration {

	public function up() {
		$this->addForeignKey('fk_product_category_id', '{{%product}}', 'category_id', 'category', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk_orderitem_order_id', '{{%order_item}}', 'order_id', 'order', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk_orderitem_product_id', '{{%order_item}}', 'product_id', 'product', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk_stock_product_id', '{{%user_stock}}', 'product_id', 'product', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk_stock_user_id', '{{%user_stock}}', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk_order_user_id', '{{%order}}', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk_order_customer_id', '{{%order}}', 'customer_id', 'customer', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk_customer_user_id', '{{%customer}}', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
		$this->addColumn('user', 'parent_id', Schema::TYPE_INTEGER);
	}

	public function down() {
		echo "m161123_080529_fk_all cannot be reverted.\n";
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
