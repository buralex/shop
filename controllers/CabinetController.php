<?php

namespace app\controllers;

use Yii;
use app\models\Product;
use app\models\Category;
use app\models\User;
use app\controllers\AppController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use yii\filters\AccessControl;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CabinetController extends AppController
{

	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'allow' => true,
						'roles' => ['@'] // authorized user
					],
				],
			],
		];
	}

	/**
	 *
	 *
	 */
	public function actionIndex()
	{
		return $this->render('index', [
			//'model' => '',
		]);
	}

}
