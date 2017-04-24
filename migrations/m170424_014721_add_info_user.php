<?php
use yii\db\Migration;

class m170424_014721_add_info_user extends Migration {

	public function up() {
		$this->addColumn('user', 'zalo', $this->string());
		$this->addColumn('user', 'viber', $this->string());
		$this->addColumn('user', 'store_address', $this->string());
		$this->addColumn('user', 'store_image', $this->string());
		$this->addColumn('user', 'store_description', $this->text());
	}

	public function down() {
		echo "m170424_014721_add_info_user cannot be reverted.\n";
		return false;
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
