<?php
namespace app\models;

use Yii;

/**
 * This is the model class for table "point".
 *
 * @property integer $id
 * @property integer $point_begin
 * @property integer $point_end
 * @property integer $discount
 * @property string  $prize
 * @property string  $created_date
 */
class Point extends \app\components\Model {

	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'point';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[
				[
					'point_begin',
					'point_end',
				],
				'required',
			],
			[
				[
					'point_begin',
					'point_end',
					'discount',
				],
				'integer',
			],
			[
				['created_date'],
				'safe',
			],
			[
				['prize'],
				'string',
				'max' => 255,
			],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
			'id'           => 'ID',
			'point_begin'  => 'Đạt điểm từ',
			'point_end'    => 'Đến',
			'prize'        => 'Phần thưởng',
			'created_date' => 'Ngày tạo',
			'discount'     => 'Giảm giá(%)',
		];
	}
}
