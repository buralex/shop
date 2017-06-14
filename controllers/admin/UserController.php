<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 12.06.2017
 * Time: 13:24
 */

namespace app\controllers\admin;

use yii\web\Controller;

class UserController extends Controller
{
	public function actionIndex()
	{
		return $this->render('index');
	}
}