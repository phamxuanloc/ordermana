<?php
namespace app\models;

use app\components\Model;
use Yii;

/**
 * This is the model class for table "user_stock".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $product_id
 * @property integer $in_stock
 * @property string  $created_date
 * @property string  $update_at
 *
 * @property Product $product
 * @property User    $user
 */
class UserStock extends Model {

	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'user_stock';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[
				[
					'user_id',
					'product_id',
				],
				'required',
			],
			[
				[
					'user_id',
					'product_id',
					'in_stock',
				],
				'integer',
			],
			[
				[
					'created_date',
					'update_at',
				],
				'safe',
			],
			[
				['product_id'],
				'exist',
				'skipOnError'     => true,
				'targetClass'     => Product::className(),
				'targetAttribute' => ['product_id' => 'id'],
			],
			[
				['user_id'],
				'exist',
				'skipOnError'     => true,
				'targetClass'     => User::className(),
				'targetAttribute' => ['user_id' => 'id'],
			],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
			'id'           => 'ID',
			'user_id'      => 'User ID',
			'product_id'   => 'Product ID',
			'in_stock'     => 'In Stock',
			'created_date' => 'Created Date',
			'update_at'    => 'Update At',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getProduct() {
		return $this->hasOne(Product::className(), ['id' => 'product_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getUser() {
		return $this->hasOne(User::className(), ['id' => 'user_id']);
	}
}
