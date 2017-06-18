<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="container">

	<?php if ( Yii::$app->session->hasFlash('success') ):?>
		<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<?= Yii::$app->session->getFlash('success') ?>
		</div>
	<?php endif; ?>

	<?php if ( Yii::$app->session->hasFlash('error') ):?>
		<div class="alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<?= Yii::$app->session->getFlash('error') ?>
		</div>
	<?php endif; ?>

	<?php if (!empty($session['cart'])): ?>
		<div class="table-responsive">
			<table class="table table-hover table-striped">
				<thead>
				<tr>
					<th>Photo</th>
					<th>Name</th>
					<th>Quantity</th>
					<th>Price</th>
					<th>Sum</th>
					<th>Delete</span></th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($session['cart'] as $id => $item): ?>
					<tr>
						<td><img src="/images/products/<?= $item['img'] ?>" alt="<?= $item['name'] ?>" height="50"></td>
						<td><a href="/product/<?= $id ?>"><?= $item['name'] ?></td>
						<td><?= $item['qty'] ?></td>
						<td><?= $item['price'] ?></td>
						<td><?= $item['price'] * $item['qty'] ?></td>
						<td><span data-id="<?= $id ?>" class="glyphicon glyphicon-remove text-danger del-item" aria-hidden="true"></span></td>
					</tr>
				<?php endforeach; ?>
				<tr>
					<td colspan="4">Total: </td>
					<td><?= $session['cart.qty'] ?></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="4">Total sum: </td>
					<td><?= $session['cart.sum'] ?></td>
					<td></td>
				</tr>
				</tbody>
			</table>
		</div>

		<?php $form = ActiveForm::begin(); ?>
		<?= $form->field($order, 'name') ?>
		<?= $form->field($order, 'email') ?>
		<?= $form->field($order, 'phone') ?>
		<?= $form->field($order, 'address') ?>
		<?= Html::submitButton('Order', ['class' => 'btn btn-success'])?>
		<?php ActiveForm::end(); ?>
	<?php else: ?>
		<h2>Cart is empty</h2>
	<?php endif; ?>
</div>
