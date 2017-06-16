<?php
/**
 * Created by PhpStorm.
 *
 */

namespace app\models;

use yii\db\ActiveRecord;

class Product extends ActiveRecord
{
	public static function tableName()
	{
		return '{{%product}}';  //without prefix
	}

	public function getCategory()
	{
		return $this->hasOne(Category::className(), ['id' => 'category_id']); // category.id
	}
}