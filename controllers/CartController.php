<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 16.06.2017
 * Time: 19:22
 */

namespace app\controllers;
use Yii;
use app\models\Product;
use app\models\Category;
use app\models\Cart;
use app\models\Order;
use app\models\OrderItems;
use app\controllers\AppController;

class CartController extends AppController
{
	public function actionShow()
	{
		$session = Yii::$app->session;
		$session->open();

		$this->layout = false;
		return $this->render('cart-modal', compact('session'));
	}

	/**
	 * @inheritdoc
	 */
	public function actionView()
	{
		$session = Yii::$app->session;
		$session->open();
		$this->setMeta('Cart');

		$order = new Order;

		if ($order->load(Yii::$app->request->post())) {
			$order->qty = $session['cart.qty'];
			$order->sum = $session['cart.sum'];

			if ($order->save()) {
				$this->saveOrderItems($session['cart'], $order->id);

				Yii::$app->session->setFlash('success', 'Your order is accepted, we will call you back shortly.');
				Yii::$app->mailer->compose('order', ['session' => $session])
					->setFrom(['shoptesttask@gmail.com' => 'shop'])
					->setTo($order->email)
					->setSubject('shop order')
					->send();
				Yii::$app->mailer->compose('order', ['session' => $session])
					->setFrom(['shoptesttask@gmail.com' => 'shop'])
					->setTo(Yii::$app->params['adminEmail'])
					->setSubject("shop order from {$order->name}, {$order->email}, {$order->phone}")
					->send();

				$session->remove('cart');
				$session->remove('cart.qty');
				$session->remove('cart.sum');

				return $this->refresh();
			} else {
				Yii::$app->session->setFlash('error', 'Order error');
			}
		}

		return $this->render('view', compact('session', 'order'));
	}

	/**
	 * @inheritdoc
	 */
	public function saveOrderItems($items, $order_id)
	{

		foreach ($items as $id => $item) {
			$order_items = new OrderItems();
			$order_items->order_id = $order_id;
			$order_items->product_id = $id;
			$order_items->name = $item['name'];
			$order_items->price = $item['price'];
			$order_items->qty_item = $item['qty'];
			$order_items->sum_item = $item['qty'] * $item['price'];
			$order_items->save();
		}
	}

	public function actionAdd()
	{
		$id = Yii::$app->request->get('id');
		$qty = intval(Yii::$app->request->get('qty')); // quantity

		$qty = !$qty ? 1 : $qty;

		$product = Product::findOne($id);
		if (empty($product)) return false;

		$session = Yii::$app->session;
		$session->open();

		$cart = new Cart();
		$cart->addToCart($product, $qty);

		$this->layout = false;
		return $this->render('cart-modal', compact('session'));
	}

	public function actionClear()
	{
		$session = Yii::$app->session;
		$session->open();
		$session->remove('cart');
		$session->remove('cart.qty');
		$session->remove('cart.sum');

		$this->layout = false;
		return $this->render('cart-modal', compact('session'));
	}

	public function actionDelItem()
	{
		$id = Yii::$app->request->get('id');
		$session = Yii::$app->session;
		$session->open();

		$cart = new Cart();
		$cart->recalc($id);

		$this->layout = false;
		return $this->render('cart-modal', compact('session'));
	}
}