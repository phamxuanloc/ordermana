<?php
use yii\db\Migration;
use yii\db\mysql\Schema;

class m161218_171520_initial_product_history extends Migration {

	public function safeUp() {
		$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		$this->createTable('{{%product_history}}', [
			'id'             => Schema::TYPE_PK . '',
			'category_id'    => Schema::TYPE_INTEGER . '(11) NOT NULL',
			'name'           => Schema::TYPE_STRING . '(255) NOT NULL',
			'code'           => Schema::TYPE_INTEGER . '(11)',
			'old_value'      => Schema::TYPE_INTEGER . '(11) NOT NULL DEFAULT "1"',
			'new_value'      => Schema::TYPE_INTEGER . '(11) NOT NULL DEFAULT "1"',
			'created_date'   => Schema::TYPE_TIMESTAMP,
			'receipted_date' => Schema::TYPE_DATETIME . ' NULL',
		], $tableOptions);
		$this->addForeignKey('fk_product_his_category_id', '{{%product_history}}', 'category_id', 'category', 'id', 'CASCADE', 'CASCADE');
	}

	public function safeDown() {
		$this->dropTable('{{%product_history}}');
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
