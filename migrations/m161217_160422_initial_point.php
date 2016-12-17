<?php
use yii\db\Migration;
use yii\db\mysql\Schema;

class m161217_160422_initial_point extends Migration {

	public function safeUp() {
		$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		$this->createTable('point', [
			'id'           => Schema::TYPE_PK . '',
			'point_begin'  => Schema::TYPE_INTEGER . ' NOT NULL',
			'point_end'    => Schema::TYPE_INTEGER . ' NULL',
			'prize'        => Schema::TYPE_STRING . ' NULL',
			'created_date' => Schema::TYPE_TIMESTAMP,
		], $tableOptions);
	}

	public function safeDown() {
		$this->dropTable('{{%point}}');
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
