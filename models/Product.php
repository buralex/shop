<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 13.06.2017
 * Time: 2:00
 */

namespace app\models;


use yii\db\ActiveRecord;

class Product extends ActiveRecord
{
	public static function tableName()
	{
		return 'yii_products';
	}

	public function getCategory()
	{
		return $this->hasOne(Category::className(), ['id' => 'category_id']); // categories.id
	}
}