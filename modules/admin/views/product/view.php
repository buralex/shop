<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

	<?php
	$img = $model->getImage();
	$gallery = $model->getImages();
	$img_str='';

    foreach($gallery as $img_g){

        $url_delete = "/delete/{$model->id}/{$img_g->id}";

        $img_str .= '&nbsp;&nbsp;&nbsp;&nbsp;<div class="image_update" >
        <a class="delete_img" title="delete?" href="'.$url_delete.'" data-id="'.$img_g->id.'" ><span class="glyphicon glyphicon-remove"></span></a>
        <img src=" ' . $img_g->getUrl('x80') . ' " alt="">
        </div> ';
    }


    ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            //'category_id',
			[
				'attribute' => 'category_id',
				'value' => is_object($model->category) ? $model->category->name : 'self category',
				'format' => 'html'
			],
            'name',
            'content:html',
            'price',
            'keywords',
            'description',
            //'img',
			[
				'attribute' => 'image',
				'value' => "<img src='{$img->getUrl('x80')}'>",
				'format' => 'html'
			],
			[
				'attribute' => 'images',
				'value' =>  $img_str,
				'format' => 'html',
			],
            //'hit',
			[
				'attribute' => 'hit',
				'value' => !$model->hit ? '<span class="text-danger">No</span>' : '<span class="text-success">Yes</span>',
				'format' => 'html'
			],
            //'new',
			[
				'attribute' => 'new',
				'value' => !$model->new ? '<span class="text-danger">No</span>' : '<span class="text-success">Yes</span>',
				'format' => 'html'
			],
            //'sale',
			[
				'attribute' => 'sale',
				'value' => !$model->sale ? '<span class="text-danger">No</span>' : '<span class="text-success">Yes</span>',
				'format' => 'html'
			],
        ],
    ]) ?>

</div>
