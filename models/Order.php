<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $user_id
 * @property double $total_amount
 * @property string $note
 * @property string $created_date
 * @property string $update_at
 * @property integer $status
 * @property integer $update_by
 * @property integer $type
 * @property integer $customer_id
 *
 * @property Customer $customer
 * @property User $user
 * @property OrderItem[] $orderItems
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'total_amount', 'status'], 'required'],
            [['user_id', 'status', 'update_by', 'type', 'customer_id'], 'integer'],
            [['total_amount'], 'number'],
            [['created_date', 'update_at'], 'safe'],
            [['note'], 'string', 'max' => 255],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'total_amount' => 'Total Amount',
            'note' => 'Note',
            'created_date' => 'Created Date',
            'update_at' => 'Update At',
            'status' => 'Status',
            'update_by' => 'Update By',
            'type' => 'Type',
            'customer_id' => 'Customer ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::className(), ['order_id' => 'id']);
    }
}