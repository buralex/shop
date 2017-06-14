<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 12.06.2017
 * Time: 13:53
 */

namespace app\controllers;

use app\models\Category;
use yii\web\Controller;
use app\models\TestForm;

use Yii;

class PostController extends Controller
{
	public $layout = 'basic';

	public function actionIndex()
	{
		if (Yii::$app->request->isAjax) {
			debug($_GET);
			return 'from ajax';
		}

//		$post = TestForm::findOne(3); // posts.id=3
//
//		$post->email = 'aaaaaa@aaaa.com';
////		$post->save();

//		$post->delete();

//		TestForm::deleteAll(['>', 'id', 3]);  //  delete with condition
//		debug($post);

		// model for data from client
		$model = new TestForm();

//		$model->name = 'author';                        // manual loading
//		$model->email = 'authoremail@fdsfdsf.com';
//		$model->text = 'author text';
//		$model->save();


		if ($model->load(Yii::$app->request->post())) {
//			debug($model);die;
			if ($model->save()) {
				Yii::$app->session->setFlash('success', 'data accepted');
				return $this->refresh();
			} else {
				Yii::$app->session->setFlash('error', 'Error!!!!');
			}
		}

		return $this->render('index', compact('model', 'post'));
	}

	public function actionShow()
	{
		$this->view->title = 'one post';
		$this->view->registerMetaTag(['name' => 'keywords', 'content' => 'some key words']);
		$this->view->registerMetaTag(['name' => 'description', 'content' => 'some description']);

//		$categs = Category::find()->all();
//		$categs = Category::find()->orderBy(['id' => SORT_DESC])->all();
//		$categs = Category::find()->asArray()->all();
//		$categs = Category::find()->asArray()->where('parent=685')->all();
//		$categs = Category::find()->asArray()->where(['parent' => 685])->all();
//		$categs = Category::find()->asArray()->where(['like', 'alias', 'what'])->all();
//		$categs = Category::find()->asArray()->where(['<=', 'id', 691])->all();
//		$categs = Category::find()->asArray()->where(['<=', 'id', 691])->limit(1)->all();  //multidimensional array
//		$categs = Category::find()->asArray()->where(['<=', 'id', 691])->limit(1)->one();
//		$categs = Category::find()->asArray()->where(['<=', 'id', 691])->limit(1)->one();
//		$categs = Category::find()->asArray()->where(['<=', 'id', 691])->count();

//		$categs = Category::findOne(['<=', 'id', 691]);
//		$categs = Category::findAll(['<=', 'id', 691]);

//		$sql = 'SELECT * FROM yii_categories WHERE alias LIKE :search';
//		$categs = Category::findBySql($sql, [':search' => '%what%'])->all();

//		$categs = Category::findOne(685);  // for lazy loading (and in view - $categs->product)
//		$categs = Category::find()->with('product')->where(['id' => 685])->all(); // greedy loading product - it's a method in Category

		$categs = Category::find()->with('product')->all(); // greedy loading product - it's a method in Category

//		debug($this);
		return $this->render('show', compact('categs'));
	}
}