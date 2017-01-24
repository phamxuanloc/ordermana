<?php
use yii\db\Migration;
use yii\db\mysql\Schema;

class m170124_002223_add_order_center extends Migration {

	public function safeUp() {
		$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		$this->createTable('{{%order_center}}', [
			'id'           => Schema::TYPE_PK . '',
			'user_id'      => Schema::TYPE_INTEGER . '(11) NOT NULL',
			'total_amount' => Schema::TYPE_FLOAT . ' NOT NULL',
			'note'         => Schema::TYPE_STRING . '(255) NULL',
			'created_date' => Schema::TYPE_TIMESTAMP,
			'update_at'    => Schema::TYPE_DATETIME,
			'status'       => Schema::TYPE_INTEGER . ' NOT NULL',
			'update_by'    => Schema::TYPE_INTEGER . ' NULL',
			'customer_id'  => Schema::TYPE_INTEGER . ' NULL',
		], $tableOptions);
		$this->createTable('{{%center_item}}', [
			'id'          => Schema::TYPE_PK . '',
			'order_id'    => Schema::TYPE_INTEGER . '(11) NOT NULL',
			'product_id'  => Schema::TYPE_INTEGER . '(11) NOT NULL',
			'quantity'    => Schema::TYPE_INTEGER . ' NOT NULL',
			'total_price' => Schema::TYPE_FLOAT . ' NOT NULL',
		], $tableOptions);
		$this->addForeignKey('fk_center_order_id', '{{%center_item}}', 'order_id', 'order_center', 'id', 'CASCADE', 'CASCADE');
	}

	public function safeDown() {
		$this->dropTable('{{%order_center}}');
		$this->dropTable('{{%center_item}}');
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
