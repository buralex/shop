<?php

namespace app\modules\admin\models;

use Yii;
use yii\db\ActiveRecord;



/**
 * This is the model class for table "{{%category}}".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property string $keywords
 * @property string $description
 */
class Category extends ActiveRecord
{
    /**
 * @inheritdoc
 */
	public static function tableName()
	{
		return '{{%category}}';
	}

	/**
	 * @inheritdoc
	 */
	public function getCategory()
	{
		return $this->hasOne(Category::className(), ['id' => 'parent_id']);
	}

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id'], 'integer'],
            [['name'], 'required'],
            [['name', 'keywords', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Category ID',
            'parent_id' => 'Parent category',
            'name' => 'Name',
            'keywords' => 'Keywords',
            'description' => 'Description',
        ];
    }
}
