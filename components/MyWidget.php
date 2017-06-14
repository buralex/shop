<?php


namespace app\components;
use yii\base\Widget;

class MyWidget extends Widget
{
	public $name;

	public function init()
	{
		parent::init();
		ob_start();
//		if ($this->name === null) {
//			$this->name = 'гость';
//		}
	}

	public function run()
	{
		$content = ob_get_clean();
		$content = mb_strtoupper($content, 'utf-8');

		return $this->render('my_widget', compact('content'));
//		$name = $this->name;
//		return $this->render('my_widget', compact('name'));
//		return $this->render('my_widget', ['name' => $name]);
	}
}