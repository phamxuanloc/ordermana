<?php
use yii\db\Migration;

class m161122_040418_initial_user extends Migration {

	public function up() {
		$this->insert('{{%user}}', [
			'id'            => '1',
			'role_id'       => '1',
			'username'      => 'admin',
			'password_hash' => Yii::$app->security->generatePasswordHash('123456'),
			'email'         => 'admin@gmail.com',
			'confirmed_at'  => '1456114858',
		]);
	}

	public function down() {
		echo "m161122_040418_initial_user cannot be reverted.\n";
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
