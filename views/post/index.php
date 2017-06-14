<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use mihaildev\ckeditor\CKEditor;
?>

<h1>test post</h1>

<?php //debug($model) ?>
<?php //debug($post) ?>


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


<?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal', 'id' => 'testForm']]) ?>
<?= $form->field($model, 'name')?>
<?= $form->field($model, 'email')?>
<?= yii\jui\DatePicker::widget(['name' => 'attributeName']) ?>
<?=
 $form->field($model, 'text')->widget(CKEditor::className(),[
	'editorOptions' => [
		'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
		'inline' => false, //по умолчанию false
	],
]);
?>
<?//= $form->field($model, 'text')->textarea(['rows' => '10'])?>
<?= Html::submitButton('send', ['class' => 'btn btn-success'])?>
<?php ActiveForm::end() ?>

