<?php
use yii\db\Migration;
use yii\db\mysql\Schema;

class m161126_084640_intial_item_customer extends Migration {

	public function safeUp() {
		$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		$this->createTable('{{%customer_item}}', [
			'id'                => Schema::TYPE_PK . '',
			'order_customer_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
			'product_id'        => Schema::TYPE_INTEGER . '(11) NOT NULL',
			'quantity'          => Schema::TYPE_INTEGER . ' NOT NULL',
			'total_price'       => Schema::TYPE_FLOAT . ' NOT NULL',
		], $tableOptions);
		$this->addForeignKey('fk_order_customer_item_order_id', '{{%customer_item}}', 'order_customer_id', 'order_customer', 'id', 'CASCADE', 'CASCADE');

	}

	public function safeDown() {
		$this->dropTable('{{customer_item}}');
	}
}
