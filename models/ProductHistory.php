<?php
namespace app\models;

use Yii;

/**
 * This is the model class for table "product_history".
 *
 * @property integer  $id
 * @property integer  $category_id
 * @property string   $name
 * @property integer  $code
 * @property integer  $old_value
 * @property integer  $new_value
 * @property integer  $product_id
 * @property string   $created_date
 * @property string   $receipted_date
 *
 * @property Category $category
 */
class ProductHistory extends \app\components\Model {

	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'product_history';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[
				[
					'category_id',
					'name',
				],
				'required',
			],
			[
				[
					'category_id',
					'old_value',
					'new_value',
					'product_id',
				],
				'integer',
			],
			[
				[
					'created_date',
					'receipted_date',
				],
				'safe',
			],
			[
				[
					'name',
					'code',
				],
				'string',
				'max' => 255,
			],
			[
				['category_id'],
				'exist',
				'skipOnError'     => true,
				'targetClass'     => Category::className(),
				'targetAttribute' => ['category_id' => 'id'],
			],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
			'id'             => 'ID',
			'category_id'    => 'Category ID',
			'name'           => 'Name',
			'code'           => 'Code',
			'old_value'      => 'Old Value',
			'new_value'      => 'New Value',
			'created_date'   => 'Created Date',
			'receipted_date' => 'Receipted Date',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCategory() {
		return $this->hasOne(Category::className(), ['id' => 'category_id']);
	}
}
