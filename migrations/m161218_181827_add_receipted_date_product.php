<?php
use yii\db\Migration;

class m161218_181827_add_receipted_date_product extends Migration {

	public function up() {
		$this->addColumn('product', 'receipted_date', \yii\db\mysql\Schema::TYPE_DATETIME . ' NULL');
	}

	public function down() {
		echo "m161218_181827_add_receipted_date_product cannot be reverted.\n";
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
