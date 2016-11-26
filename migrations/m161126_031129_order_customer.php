<?php
use yii\db\Migration;
use yii\db\mysql\Schema;

class m161126_031129_order_customer extends Migration {

	// Use safeUp/safeDown to run migration code within a transaction
	public function safeUp() {
		$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		$this->dropForeignKey('fk_order_customer_id', 'order');
		$this->dropColumn('order', 'customer_id');
		$this->addColumn('order', 'parent_id', Schema::TYPE_INTEGER . ' NULL');
		$this->addForeignKey('fk_order_parent_id', '{{%order}}', 'parent_id', 'user', 'id', 'CASCADE', 'CASCADE');
		$this->createTable('{{%order_customer}}', [
			'id'           => Schema::TYPE_PK . '',
			'user_id'      => Schema::TYPE_INTEGER . '(11) NOT NULL',
			'total_amount' => Schema::TYPE_FLOAT . ' NOT NULL',
			'note'         => Schema::TYPE_STRING . '(255) NULL',
			'created_date' => Schema::TYPE_TIMESTAMP,
			'update_at'    => Schema::TYPE_DATETIME,
			'status'       => Schema::TYPE_INTEGER . ' NOT NULL',
			'update_by'    => Schema::TYPE_INTEGER . ' NULL',
			'type'         => Schema::TYPE_INTEGER . ' NULL',
			'customer_id'  => Schema::TYPE_INTEGER . ' NULL',
		], $tableOptions);
		$this->addForeignKey('fk_order_customer_user_id', '{{%order_customer}}', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk_order_customer_customer_id', '{{%order_customer}}', 'customer_id', 'customer', 'id', 'CASCADE', 'CASCADE');
	}

	public function safeDown() {
		$this->dropTable('{{%order}}');
	}
}
