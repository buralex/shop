<?php

namespace app\modules\admin\models;

use Yii;
use app\modules\admin\models\Category;

/**
 * This is the model class for table "{{%product}}".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $name
 * @property string $content
 * @property double $price
 * @property string $keywords
 * @property string $description
 * @property string $img
 * @property string $hit
 * @property string $new
 * @property string $sale
 */
class Product extends \yii\db\ActiveRecord
{
	public $image;
	public $gallery;

	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			'image' => [
				'class' => 'rico\yii2images\behaviors\ImageBehave',
			]
		];
	}

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product}}';
    }

	/**
	 * @inheritdoc
	 */
	public function getCategory()
	{
		return $this->hasOne(Category::className(), ['id' => 'category_id']);
	}

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'name'], 'required'],
            [['category_id'], 'integer'],
            [['content', 'hit', 'new', 'sale'], 'string'],
            [['price'], 'number'],
            [['name', 'keywords', 'description', 'img'], 'string', 'max' => 255],
			[['image'], 'file', 'extensions' => 'png, jpg'],
			[['gallery'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Product ID',
            'category_id' => 'Category',
            'name' => 'Name',
            'content' => 'Content',
            'price' => 'Price',
            'keywords' => 'Keywords',
            'description' => 'Description',
            'image' => 'Image',
            'gallery' => 'Gallery (4 files)',
            'hit' => 'Hit',
            'new' => 'New',
            'sale' => 'Sale',
        ];
    }

	/**
	 * @inheritdoc
	 */
	public function upload()
	{
		if ($this->validate()) {
			$path = 'upload/store/' . $this->image->baseName . '.' . $this->image->extension;
			$this->image->saveAs($path);
			$this->attachImage($path, $path);
			//@unlink($path);
			unlink($path);
			return true;
		} else {
			return false;
		}
	}

	/**
	 * @inheritdoc
	 */
	public function uploadGallery()
	{
		if ($this->validate()) {

			foreach ($this->gallery as $file) {
				$path = 'upload/store/' . $file->baseName . '.' . $file->extension;
				$file->saveAs($path);
				$this->attachImage($path);
				//@unlink($path);
				unlink($path);
			}
			//debug($this->gallery);die;
			return true;
		} else {
			return false;
		}
	}
}
