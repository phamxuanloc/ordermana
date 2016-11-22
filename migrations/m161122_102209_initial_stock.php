<?php
use yii\db\Migration;
use yii\db\mysql\Schema;

class m161122_102209_initial_stock extends Migration {

	public function safeUp() {
		$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		$this->createTable('{{%user_stock}}', [
			'id'           => Schema::TYPE_PK . '',
			'user_id'      => Schema::TYPE_INTEGER . '(11) NOT NULL',
			'product_id'   => Schema::TYPE_INTEGER . '(11) NOT NULL',
			'in_stock'     => Schema::TYPE_INTEGER . '(11) NOT NULL DEFAULT "1"',
			'created_date' => Schema::TYPE_TIMESTAMP,
			'update_at'    => Schema::TYPE_DATETIME,
		], $tableOptions);
	}

	public function safeDown() {
		$this->dropTable('{{%user_stock}}');
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
