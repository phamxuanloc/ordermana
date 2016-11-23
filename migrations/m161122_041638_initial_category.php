<?php
use yii\db\Migration;
use yii\db\mysql\Schema;

class m161122_041638_initial_category extends Migration {

	public function safeUp() {
		$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		$this->createTable('{{%category}}', [
			'id'         => Schema::TYPE_PK . '',
			'parent_id'  => Schema::TYPE_INTEGER . '(11) NOT NULL DEFAULT "0"',
			'type'       => Schema::TYPE_INTEGER . '(11)',
			'sort_order' => Schema::TYPE_INTEGER . '(11)',
			'image'      => Schema::TYPE_STRING . '(255)',
		], $tableOptions);
		$this->insert('{{%category}}', [
			'id'         => '1',
			'parent_id'  => '0',
			'type'       => '3',
			'sort_order' => '',
			'image'      => '',
		]);
	}

	public function safeDown() {
		$this->dropTable('{{%category}}');
	}
}
