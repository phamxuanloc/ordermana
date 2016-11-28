<?php
use yii\db\Migration;
use yii\db\mysql\Schema;

class m161128_163004_add_city extends Migration {

	public function safeUp() {
		$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		$this->createTable('{{%city}}', [
				'id'     => Schema::TYPE_PK . '',
				'name'   => Schema::TYPE_STRING . '(255) NOT NULL',
				'status' => Schema::TYPE_INTEGER . '(1) NOT NULL',
			], $tableOptions);
		$this->insert('{{%city}}', ['id'     => '1',
		                            'name'   => 'An Giang',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '2',
		                            'name'   => 'Ba Ria  Vung Tau',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '3',
		                            'name'   => 'Bac Giang',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '4',
		                            'name'   => 'Bac Kan',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '5',
		                            'name'   => 'Bac Lieu',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '6',
		                            'name'   => 'Bac Ninh',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '7',
		                            'name'   => 'Ben Tre',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '8',
		                            'name'   => 'Binh Dinh',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '9',
		                            'name'   => 'Binh Duong',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '10',
		                            'name'   => 'Binh Phuoc',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '11',
		                            'name'   => 'Binh Thuan',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '12',
		                            'name'   => 'Ca Mau',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '13',
		                            'name'   => 'Cao Bang',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '14',
		                            'name'   => 'Dak Lak',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '15',
		                            'name'   => 'Dak Nong',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '16',
		                            'name'   => 'Dien Bien',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '17',
		                            'name'   => 'Dong Nai',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '18',
		                            'name'   => 'Dong Thap',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '19',
		                            'name'   => 'Gia Lai',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '20',
		                            'name'   => 'Ha Giang',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '21',
		                            'name'   => 'Ha Nam',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '22',
		                            'name'   => 'Ha Tinh',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '23',
		                            'name'   => 'Hai Duong',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '24',
		                            'name'   => 'Hau Giang',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '25',
		                            'name'   => 'Hoa Binh',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '26',
		                            'name'   => 'Hung Yen',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '27',
		                            'name'   => 'Khanh Hoa',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '28',
		                            'name'   => 'Kien Giang',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '29',
		                            'name'   => 'Kon Tum',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '30',
		                            'name'   => 'Lai Chau',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '31',
		                            'name'   => 'Lam Dong',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '32',
		                            'name'   => 'Lang Son',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '33',
		                            'name'   => 'Lao Cai',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '34',
		                            'name'   => 'Long An',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '35',
		                            'name'   => 'Nam Dinh',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '36',
		                            'name'   => 'Nghe An',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '37',
		                            'name'   => 'Ninh Binh',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '38',
		                            'name'   => 'Ninh Thuan',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '39',
		                            'name'   => 'Phu Tho',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '40',
		                            'name'   => 'Quang Binh',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '41',
		                            'name'   => 'Quang Nam',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '42',
		                            'name'   => 'Quang Ngai',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '43',
		                            'name'   => 'Quang Ninh',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '44',
		                            'name'   => 'Quang Tri',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '45',
		                            'name'   => 'Soc Trng',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '46',
		                            'name'   => 'Son La',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '47',
		                            'name'   => 'Tay Ninh',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '48',
		                            'name'   => 'Thai Binh',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '49',
		                            'name'   => 'Thai Nguyen',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '50',
		                            'name'   => 'Thanh Hoa',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '51',
		                            'name'   => 'Thua Thien Hue',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '52',
		                            'name'   => 'Tien Giang',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '53',
		                            'name'   => 'Tra Vinh',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '54',
		                            'name'   => 'Tuyen Quang',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '55',
		                            'name'   => 'Vinh Long',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '56',
		                            'name'   => 'Vinh Phuc',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '57',
		                            'name'   => 'Yen Bai',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '58',
		                            'name'   => 'Phu Yen',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '59',
		                            'name'   => 'Can Tho',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '60',
		                            'name'   => 'Da Nang',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '61',
		                            'name'   => 'Hai Phong',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '62',
		                            'name'   => 'Ha Noi',
		                            'status' => '1',
		]);
		$this->insert('{{%city}}', ['id'     => '63',
		                            'name'   => 'TP HCM',
		                            'status' => '1',
		]);
		$this->addColumn('user','city',Schema::TYPE_INTEGER.' NULL');
	}

	public function safeDown() {
		$this->dropTable('{{%city}}');
	}
}
