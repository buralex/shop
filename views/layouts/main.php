<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\bootstrap\Modal;
use app\assets\AppAsset;
use app\assets\LthanAsset;

AppAsset::register($this);
LthanAsset::register($this);
?>

<?php $this->beginPage()?>
<!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
    <title><?= Html::encode($this->title) ?></title>

	<link rel="shortcut icon" href="images/ico/favicon.ico">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">

    <?= Html::csrfMetaTags() ?>
	<?php $this->head() ?>
</head><!--/head-->

<body>
<?php $this->beginBody() ?>
<div class="main-wrapper">
    <!-- HEADER -->
    <header id="header"><!--header-->
        <div class="header_top"><!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header_top-->

        <div class="header-middle"><!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="/"><?= Html::img("@web/images/home/logo.png", ['alt' => 'Shop', 'height' => '60']) ?></a>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">

                                <li><a href="/cart/view"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                                <li><a id="cartBtn" href=""><i class="fa fa-shopping-cart"></i> Cart</a></li>

								<?php if (Yii::$app->user->isGuest): ?>
                                    <li><a href="/site/login/"><i class="fa fa-lock"></i> Log in</a></li>
								<?php else: ?>
                                    <li>
                                        <a href="/cabinet">
                                            <i class="fa fa-user"></i>Account: <?= Yii::$app->user->identity['username'] ?>
                                        </a>
                                    </li>
                                    <li><a href="/site/logout/"><i class="fa fa-unlock"></i> Log out</a></li>
								<?php endif; ?>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-middle-->

        <div class="header-bottom"><!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse"
                                    data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="/" class="active">Home</a></li>
                                <li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="/cart/view">Checkout</a></li>
                                    </ul>
                                </li>
                                <li><a href="/about">About</a></li>
                                <li><a href="/contact">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="search_box pull-right">
                            <form method="get" action="/search">
                                <input type="text" placeholder="Product name" name="q">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-bottom-->
    </header>
    <!-- /HEADER -->

    <!-- CONTENT -->
    <div class="container">
		<?php if (Yii::$app->session->hasFlash('success')): ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
				<?= Yii::$app->session->getFlash('success') ?>
            </div>
		<?php endif; ?>

		<?php if (Yii::$app->session->hasFlash('error')): ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
				<?= Yii::$app->session->getFlash('error') ?>
            </div>
		<?php endif; ?>

		<?= $content ?>
    </div>

    <!-- /CONTENT --></div>
<!-- FOOTER -->
<footer id="footer">
	<div class="footer-bottom">
		<div class="container">
			<div class="row">
				<p class="pull-left">Copyright © 2017 SHOP Inc. All rights reserved.</p>
				<p class="pull-right">Designed by Lorem ipsum (yii2)</p>
			</div>
		</div>
	</div>
</footer>
<!-- /FOOTER -->

<?php

Modal::begin([
    'header' => '<h2>Cart<h2>',
    'id' => 'cart',
    'size' => 'modal-lg',
    'footer' => '<button type="button" class="btn btn-default" data-dismiss="modal">Continue shopping</button>
        <a href="/cart/view" class="btn btn-success">Checkout</a>
        <button id="clearCart" type="button" class="btn btn-danger">Clear Cart</button>'
]);

Modal::end();

?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>