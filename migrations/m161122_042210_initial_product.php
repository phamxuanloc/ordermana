<?php
use yii\db\Migration;
use yii\db\mysql\Schema;

class m161122_042210_initial_product extends Migration {

	public function safeUp() {
		$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		$this->createTable('{{%product}}', [
			'id'              => Schema::TYPE_PK . '',
			'category_id'     => Schema::TYPE_INTEGER . '(11) NOT NULL',
			'name'            => Schema::TYPE_STRING . '(255) NOT NULL',
			'code'            => Schema::TYPE_INTEGER . '(11)',
			'image'           => Schema::TYPE_STRING . '(255)',
			'in_stock'        => Schema::TYPE_INTEGER . '(11) NOT NULL DEFAULT "1"',
			'base_price'      => Schema::TYPE_FLOAT . ' NOT NULL',
			'description'     => Schema::TYPE_TIME . ' NULL',
			'distribute_sale' => Schema::TYPE_FLOAT . ' NOT NULL',
			'agent_sale'      => Schema::TYPE_FLOAT . ' NOT NULL',
			'retail_sale'     => Schema::TYPE_FLOAT . ' NOT NULL',
			'created_date'    => Schema::TYPE_TIMESTAMP,
		], $tableOptions);
	}

	public function safeDown() {
		$this->dropTable('{{%product}}');
	}
}
