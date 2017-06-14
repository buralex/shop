<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 12.06.2017
 * Time: 19:43
 */

namespace app\models;
use yii\db\ActiveRecord;

class TestForm extends ActiveRecord
{
//	public $name;
//	public $email;
//	public $text;

	public static function tableName()
	{
		return 'yii_posts';
	}

	public function attributeLabels()
	{
		return [
			'name' => 'NAME',
			'email' => 'EMAIL',
			'text' => 'TEXT',
		];
	}

	//validation
	public function rules()
	{
		return [
			[['name','text'], 'required', 'message' => 'REQUIRED!!!'],
			['email', 'email', 'message' => 'not email!!!!!!!!'],
//			['name', 'string', 'min' => 2, 'tooShort' => 'must be greater than 2 !!!'],
//			['name', 'string', 'max' => 10, 'tooLong' => 'must be less than 10 !!!'],
//			['name', 'string', 'length' => [2,5],
//				'tooShort' => 'must be greater than 2 !!!',
//				'tooLong' => 'must be less than 5 !!!'],
//			['name', 'myRule'],
			['text', 'trim'],
		];
	}

//	public function myRule($attr)
//	{
//		if (!in_array($this->$attr, ['hello', 'world'])) {
//			$this->addError($attr, 'Wrong name!');
//		}
//	}
}