<?php
use yii\db\Migration;
use yii\db\mysql\Schema;

class m161214_095041_initial_alert extends Migration {

	// Use safeUp/safeDown to run migration code within a transaction
	public function safeUp() {
		$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		$this->createTable('alert', [
			'id'           => Schema::TYPE_PK . '',
			'content'      => Schema::TYPE_STRING . '(255) NOT NULL',
			'role_id'      => Schema::TYPE_INTEGER . ' NULL',
			'created_date' => Schema::TYPE_TIMESTAMP,
		], $tableOptions);
	}

	public function safeDown() {
		$this->dropTable('{{%alert}}');
	}
}
