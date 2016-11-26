<?php
use yii\db\Migration;
use yii\db\mysql\Schema;

class m161126_024343_add_column_to_product extends Migration {

	public function safeUp() {
		$this->addColumn('product', 'supplier', Schema::TYPE_STRING . ' NULL');
		$this->addColumn('product', 'order_number', Schema::TYPE_INTEGER . ' NULL');
		$this->addColumn('product', 'bill_number', Schema::TYPE_STRING . ' NULL');
		$this->addColumn('product', 'bill_image', Schema::TYPE_STRING . '(255) NULL');
		$this->addColumn('product', 'receiver', Schema::TYPE_STRING . '(255) NULL');
		$this->addColumn('product', 'deliver', Schema::TYPE_STRING . '(255) NULL');
		$this->addColumn('product', 'color', Schema::TYPE_STRING . '(255) NULL');
		$this->addColumn('product', 'weight', Schema::TYPE_INTEGER . ' NULL');
		$this->addColumn('product', 'unit', Schema::TYPE_STRING . '(255) NULL');
		$this->addColumn('product', 'status', Schema::TYPE_INTEGER . ' NOT NULL DEFAULT "0"');
		$this->addColumn('product', 'price_tax', Schema::TYPE_FLOAT . ' NULL ');
		$this->addColumn('product', 'supplier_discount', Schema::TYPE_INTEGER . ' NOT NULL DEFAULT "0"');
		$this->addColumn('product', 'updated_date', Schema::TYPE_DATETIME . ' NULL');
	}

	public function safeDown() {
		return false;
	}
}
