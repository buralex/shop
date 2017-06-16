<?php
/**
 *
 */

namespace app\models;

use yii\db\ActiveRecord;

class Category extends ActiveRecord
{
	public static function tableName()
	{
		return '{{%category}}'; //without prefix
	}

	public function getProduct()
	{
		return $this->hasMany(Product::className(), ['category_id' => 'id']); // category.id
	}
}