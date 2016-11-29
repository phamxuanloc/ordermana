<?php
namespace app\models;

use app\components\Model;
use Yii;

/**
 * This is the model class for table "category".
 *
 * @property integer   $id
 * @property integer   $parent_id
 * @property integer   $status
 * @property integer   $sort_order
 * @property string    $image
 *
 * @property Product[] $products
 */
class Category extends Model {

	const STATUS   = [
		'Inactive',
		'Active',
	];

	const INACTIVE = 0;

	const ACTIVE   = 1;

	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'category';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[
				[
					'parent_id',
					'status',
					'sort_order',
				],
				'integer',
			],
			[
				[
					'image',
					'name',
				],
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
			'id'         => 'ID',
			'parent_id'  => 'Parent ID',
			'status'     => 'Status',
			'sort_order' => 'Sort Order',
			'image'      => 'Image',
			'name'       => 'Tên',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getProducts() {
		return $this->hasMany(Product::className(), ['category_id' => 'id']);
	}
}
