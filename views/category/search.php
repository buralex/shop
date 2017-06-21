<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use app\components\MenuWidget;
use yii\widgets\LinkPager;
//use yii\helpers\Url;

?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Category</h2>
                    <!--catalog_products-->
                    <ul class="catalog category-products">
						<?= MenuWidget::widget(['templ' => 'menu']);?>
                    </ul>
                    <!--/catalog_products-->

                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <!--featured_items-->
                <div class="featured_items">
                    <h2 class="title text-center">query <?= Html::encode($q); ?></h2>

					<?php if (!empty($products)): ?>

						<?php foreach (array_chunk($products, 3, true) as $products_arr):?>

                            <div class="row">
								<?php foreach ($products_arr as $product): ?>

                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
													<?= Html::img("@web/images/products/{$product->img}", ['alt' => $product->name])?>
                                                    <h2>$<?= $product->price ?></h2>

                                                    <p><a href="/product/<?= $product->id ?>"><?= $product->name ?></a></p>
                                                    <a href="#" data-id="<?= $product->id ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                                </div>

												<?php if ($product->new): ?>
													<?= Html::img("@web/images/home/new.png", ['class' => 'new', 'alt' => 'new'])?>
												<?php endif; ?>
												<?php if ($product->sale): ?>
													<?= Html::img("@web/images/home/sale.png", ['class' => 'new', 'alt' => 'sale'])?>
												<?php endif; ?>
                                            </div>
                                            <div class="choose">
                                                <ul class="nav nav-pills nav-justified">
                                                    <li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                                    <li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
								<?php endforeach; ?>
                            </div>

						<?php endforeach; ?>
						<?php
						echo LinkPager::widget([
							'pagination' => $pages,
						]);
						?>

					<?php else :?>
                        <h2>not found</h2>
					<?php endif; ?>
                </div>
                <!--featured_items-->
            </div>
        </div>
    </div>
</section>