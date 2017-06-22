<?php
//debug($hits);
/* @var $this yii\web\View */

use yii\helpers\Html;
use app\components\MenuWidget;
use yii\helpers\Url;

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

			<?php
            $mainImg = $product->getImage();
            $gallery = $product->getImages();
            ?>

			<div class="col-sm-9 padding-right">
				<div class="product-details"><!--product-details-->
					<div class="col-sm-5">

                        <div class="container carousel-wrap">
                            <div id="main_area">
                                <!-- Slider -->
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="col-xs-12" id="slider">
                                            <!-- Top part of the slider -->
                                            <div class="row">
                                                <div class="col-sm-12" id="carousel-bounding-box">
                                                    <div class="carousel slide" id="myCarousel">
                                                        <!-- Carousel items -->
                                                        <div class="carousel-inner">
															<?php $k = 0; foreach($gallery as $img):?>
                                                                <div class="<?php if ($k == 0) echo 'active'; ?> item" data-slide-number="<?= $k ?>">
                                                                    <img src="<?= $img->getUrl('x200') ?>">
                                                                </div>
															<?php $k++; endforeach; ?>


                                                        </div>
                                                        <!-- Carousel nav -->
                                                        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                                            <span class="glyphicon glyphicon-chevron-left"></span>
                                                        </a>
                                                        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                                            <span class="glyphicon glyphicon-chevron-right"></span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12" id="slider-thumbs">
                                        <!-- Bottom switcher of slider -->
                                        <ul class="hide-bullets">
											<?php $count = count($gallery); $i = 0; foreach($gallery as $img):?>
                                                <li class="col-sm-3">
                                                    <a class="thumbnail" id="carousel-selector-<?= $i ?>">
                                                        <img src="<?= $img->getUrl() ?>">
                                                    </a>
                                                </li>
												<?php $i++; endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                                <!--/Slider-->

                            </div>
                        </div>

					</div>
					<div class="col-sm-7">
						<div class="product-information"><!--/product-information-->

							<?php if ($product->new): ?>
								<?= Html::img("@web/images/home/new.png", ['class' => 'new', 'alt' => 'new'])?>
							<?php endif; ?>
							<?php if ($product->sale): ?>
								<?= Html::img("@web/images/home/sale.png", ['class' => 'new', 'alt' => 'sale'])?>
							<?php endif; ?>
							<h2><?= $product->name ?></h2>
							<p>Web ID: 1089772</p>
							<img src="/images/product-details/rating.png" alt="" />
							<span>
									<span>US $<?= $product->price ?></span>
									<label>Quantity:</label>
									<input type="text" value="1" id="qty">
									<a href="#" data-id="<?= $product->id ?>" class="btn btn-fefault add-to-cart cart">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</a>
								</span>
							<p><b>Availability:</b> In Stock</p>
							<p><b>Condition:</b> New</p>
							<p><b>Brand:</b> <a href="/category/<?= $product->category->id ?>"><?= $product->category->name ?></a></p>
							<a href=""><img src="/images/product-details/share.png" class="share img-responsive"  alt="" /></a>
                            <br>
                            <p><?= $product->content ?></p>

                        </div><!--/product-information-->
					</div>
				</div><!--/product-details-->

                <!--recommended_items-->
				<div class="recommended_items">
					<h2 class="title text-center">recommended items</h2>

					<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner">

                        <!--open and close div by condition-->
                        <?php $count = count($hits); $i=0; foreach ($hits as $hit): ?>
							<?php if ($i % 3 == 0 ): ?>
							<div class="item <?php if ($i == 0) echo 'active'; ?>">
							<?php endif; ?>
								<div class="col-sm-4">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="<?= $mainImg->getUrl() ?>" alt="<?= $hit->name; ?>" />
												<h2>$<?= $hit->price; ?></h2>
												<p><a href="/product/<?= $hit->id ?>"><?= $hit->name; ?></p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
							<?php $i++; if ($i % 3 == 0 || $i == $count): ?>
							</div>
							<?php endif; ?>
						<?php endforeach; ?>

						</div>
						<a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
				</div>
                <!--/recommended_items-->

			</div>
		</div>
	</div>
</section>