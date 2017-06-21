<section>
	<div class="container">
		<div class="row">

			<h3>User cabinet</h3>

			<h4>Hi, <?= Yii::$app->user->identity['username'] ?>!</h4>


			<?php if (Yii::$app->user->identity['role'] === 'admin'): ?>
                <a class="btn btn-success" href="/admin">Go to Admin Panel</a>
			<?php endif; ?>

		</div>
	</div>
</section>