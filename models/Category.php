<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 13.06.2017
 * Time: 2:00
 */

namespace app\models;


use yii\db\ActiveRecord;

class Category extends ActiveRecord
{
	public static function tableName()
	{
		return 'yii_categories';
	}

	public function getProduct()
	{
		return $this->hasMany(Product::className(), ['category_id' => 'id']); // categories.id
	}
}