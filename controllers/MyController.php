<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 12.06.2017
 * Time: 12:50
 */

namespace app\controllers;
use yii\web\Controller;

class MyController extends Controller
{
	public function actionIndex($id=null)
	{
		$names = ['ivanoe', 'prjkjjd', 'fjfjjfjf'];
		return $this->render('index', compact('names', 'id'));
	}
}