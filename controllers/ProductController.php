<?php

namespace app\controllers;

use Yii;
use app\models\Product;
use app\models\Category;
use app\controllers\AppController;

/**
 * ProductsController implements the CRUD actions for Products model.
 */
class ProductController extends AppController
{
    /**
     * Displays a single Products model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
		$product = Product::findOne($id); // lazy loading
//		$product = Product::find()->with('category')->where(['id' => $id])->limit(1)->one(); // greedy loading

		if ( empty($product) ) { // item does not exist
			throw new \yii\web\HttpException(404, 'There is no such category');
		}

		$hits = Product::find()->where(['hit' => '1'])->limit(6)->all();
		$this->setMeta('Shop | ' . $product->name, $product->keywords, $product->description);
		return $this->render('view', compact('product', 'hits'));
    }

}
