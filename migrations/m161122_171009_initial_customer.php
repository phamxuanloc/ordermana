<?php
use yii\db\Migration;
use yii\db\mysql\Schema;

class m161122_171009_initial_customer extends Migration {

	public function safeUp() {
		$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		$this->createTable('{{%customer}}', [
			'id'           => Schema::TYPE_PK . '',
			'name'         => Schema::TYPE_STRING . '(255) NOT NULL',
			'address'      => Schema::TYPE_STRING . '(255) NULL',
			'email'        => Schema::TYPE_STRING . '(255) NULL',
			'company_name' => Schema::TYPE_STRING . '(255) NULL',
			'phone'        => Schema::TYPE_INTEGER . '(11) NOT NULL',
			'city_id'      => Schema::TYPE_INTEGER . '(11)',
		], $tableOptions);
	}

	public function safeDown() {
		$this->dropTable('{{%customer}}');
	}
}
