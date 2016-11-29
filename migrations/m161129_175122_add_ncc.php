<?php
use yii\db\Migration;
use yii\db\mysql\Schema;

class m161129_175122_add_ncc extends Migration {

	public function safeUp() {
		$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		$this->createTable('{{%provider}}', [
			'id'           => Schema::TYPE_PK . '',
			'name'         => Schema::TYPE_STRING . '(255) NOT NULL',
			'address'      => Schema::TYPE_STRING . '(255) NULL',
			'phone'        => Schema::TYPE_STRING . '(255) NULL',
			'created_date' => Schema::TYPE_TIMESTAMP,
			'email'        => Schema::TYPE_STRING . '(255) NULL',
			'note'         => Schema::TYPE_TEXT . ' NULL',
			'company'      => Schema::TYPE_STRING . '(255) NULL',
			'tax_code'     => Schema::TYPE_STRING . '(255) NULL',
			'payment'      => Schema::TYPE_INTEGER . '(5) NULL',
		], $tableOptions);
		$this->addColumn('user', 'facebook_link', Schema::TYPE_STRING . '(255) NULL');
		$this->addColumn('product', 'provider_id', Schema::TYPE_INTEGER . ' NULL');
	}

	public function safeDown() {
		$this->dropTable('{{%provider}}');
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
