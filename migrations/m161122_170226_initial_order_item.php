<?php
use yii\db\Migration;
use yii\db\mysql\Schema;

class m161122_170226_initial_order_item extends Migration {

	public function safeUp() {
		$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		$this->createTable('{{%order_item}}', [
			'id'          => Schema::TYPE_PK . '',
			'order_id'    => Schema::TYPE_INTEGER . '(11) NOT NULL',
			'product_id'  => Schema::TYPE_INTEGER . '(11) NOT NULL',
			'quantity'    => Schema::TYPE_INTEGER . ' NOT NULL',
			'total_price' => Schema::TYPE_FLOAT . ' NOT NULL',
		], $tableOptions);
	}

	public function safeDown() {
		$this->dropTable('{{%order_item}}');
	}
}
