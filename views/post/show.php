<?php
use app\components\MyWidget;
?>
<h1>show action</h1>

<?php
//    $this->registerJSFile('@web/js/main.js', [ 'depends' => 'yii\web\YiiAsset']);
?>

<?php $this->beginBlock('block1'); ?>
    <h1>header of the page</h1>
<?php $this->endBlock(); ?>

<?php //foreach ($categs as $categ): ?>
<!--	--><?//= $categ['title'] ?><!--</br>-->
<?php //endforeach; ?>

<?php //debug($categs) ?>
<?php //echo count($categs->product) ?>
<?php //debug($categs) ?>

<?php //debug($categs) ?>
<?php //debug($categs[0]) ?>
<?php ////echo count($categs[0]->product) ?>
<?php ////debug($categs) ?>
<?php ////debug($categs[0]->product[0]->title) ?>
<!---->
<?php //foreach ($categs as $categ): ?>
<!--    <ul>-->
<!--        <li>--><?//= $categ->title ?><!--</li>-->
<!--        <li>-->
<!--			--><?php //foreach ($categ->product as $product): ?>
<!--                <ul>-->
<!--                    <li>--><?//= $product->title ?><!--</li>-->
<!--                </ul>-->
<!--			--><?php //endforeach; ?>
<!--        </li>-->
<!--    </ul>-->
<?php //endforeach; ?>

<?//= MyWidget::widget(['name' => 'вася']); ?>

<?php MyWidget::begin()?>
    <h1> hi world</h1>
<?php MyWidget::end()?>

<button class="btn btn-success" id="btn">click me</button>

<?php
$script = <<< JS
$('#btn').on('click', function(e) {
    $.ajax({
       url: 'index.php/?r=post/index',
       data: {id: '<id>', 'other': '<other>'},
       type: 'POST',
       success: function(res) {
           console.log(res);
       },
       error: function(res) {
           throw new Error(res);
       }
    });
});
JS;
$this->registerJs($script);
// where $position can be View::POS_READY (the default),
// or View::POS_HEAD, View::POS_BEGIN, View::POS_END
?>
