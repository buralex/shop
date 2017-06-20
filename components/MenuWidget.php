<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 14.06.2017
 * Time: 19:52
 */

namespace app\components;

use yii\base\Widget;
use app\models\Category;
use Yii;

class MenuWidget extends Widget
{
	public $templ;
	public $model;
	public $data;
	public $tree;
	public $menuHtml;

	public function init()
	{
		parent::init();

		if ($this->templ === null) {
			$this->templ = 'menu';
		}
		$this->templ .= '.php';
	}

	public function run()
	{
		// get cache
		if ($this->templ == 'menu.php') {
			$menu = Yii::$app->cache->get('menu');
			if ($menu) return $menu;
		}

		$this->data = Category::find()->indexBy('id')->asArray()->all();
		$this->tree = $this->getTree();
		$this->menuHtml = $this->getMenuHtml($this->tree);

		// set cache
		if ($this->templ == 'menu.php') {
			Yii::$app->cache->set('menu', $this->menuHtml, 60);  // 60 sec
		}

		return $this->menuHtml;
	}

	protected function getTree()
	{
		$tree = [];
		foreach ($this->data as $id=>&$node){
			if (!$node['parent_id']) {
				$tree[$id] = &$node;
			} else {
				$this->data[$node['parent_id']]['childs'][$node['id']] = &$node;
			}
		}
		return $tree;
	}

	protected function getMenuHtml($tree, $tab = '')
	{
		$str = '';
		foreach ($tree as $category){
			$str .= $this->catToTemplate($category, $tab);
		}
		return $str;
	}

	protected function catToTemplate($category, $tab)
	{
		ob_start();
		include  __DIR__ .'/menu_templ/' . $this->templ;
		return ob_get_clean();
	}
}