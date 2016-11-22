<?php
use yii\db\Migration;
use yii\db\mysql\Schema;

class m161122_163857_initial_order extends Migration {

	public function safeUp() {
		$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		$this->createTable('{{%order}}', [
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
	}

	public function safeDown() {
		$this->dropTable('{{%order}}');
	}
}
