<?php

namespace app\controllers;

use Yii;
use app\models\Product;
use app\models\Category;
use app\controllers\AppController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends AppController
{

    /**
     * Lists all Categories models.
     * @return mixed
     */
    public function actionIndex()
    {
		$hits = Product::find()->where(['hit' => '1'])->limit(6)->all();
		$this->setMeta('Shop');
        return $this->render('index', compact('hits'));
    }

    public function actionView($id)
	{
		//$id = Yii::$app->request->get('id');

		$category = Category::findOne($id);

		if ( empty($category) ) { // item does not exist
			throw new \yii\web\HttpException(404, 'There is no such category');
		}

		$products = Product::find()->where(['category_id' => $id])->all();
		$query = Product::find()->where(['category_id' => $id]);
		$pages = new Pagination([
			'totalCount' => $query->count(),
			'pageSize' => 4,
			'forcePageParam' => false,
			'pageSizeParam' => false
		]);

		$products = $query->offset($pages->offset)->limit($pages->limit)->all();

		$this->setMeta('Shop | ' . $category->name, $category->keywords, $category->description);
		return $this->render('view', compact('products', 'pages', 'category'));
	}

	public function actionSearch()
	{
		$q = trim(Yii::$app->request->get('q'));
		if (!$q) {
			return $this->render('search');
		}

		$query = Product::find()->where(['like', 'name', $q]);
		$pages = new Pagination([
			'totalCount' => $query->count(),
			'pageSize' => 4,
			'forcePageParam' => false,
			'pageSizeParam' => false
		]);
		$products = $query->offset($pages->offset)->limit($pages->limit)->all();
		$this->setMeta('Shop | ' . $q);

		return $this->render('search', compact('products', 'pages', 'q'));
	}

}
