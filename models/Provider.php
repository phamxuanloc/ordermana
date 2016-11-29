<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "provider".
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $phone
 * @property string $created_date
 * @property string $email
 * @property string $note
 * @property string $company
 * @property string $tax_code
 * @property integer $payment
 */
class Provider extends \app\components\Model
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'provider';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['created_date'], 'safe'],
            [['note'], 'string'],
            [['payment'], 'integer'],
            [['name', 'address', 'phone', 'email', 'company', 'tax_code'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên nhà cung cấp',
            'address' => 'Địa chỉ',
            'phone' => 'Số điện thoại',
            'created_date' => 'Ngày tạo',
            'email' => 'Email',
            'note' => 'Ghi chú',
            'company' => 'Tên công ty',
            'tax_code' => 'Mã số thuế',
            'payment' => 'Hình thức thanh toán',
        ];
    }
}
