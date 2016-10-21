<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
use karpoff\icrop\CropImageUpload;

/*
  use kartik\widgets\FileInput;
  use kartik\widgets\ActiveForm;
 */
/* @var $this yii\web\View */
/* @var $model backend\modules\inventory\models\InvtType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="invt-type-form">

    <?php
    $form = ActiveForm::begin([
                'id' => 'addAvatar',
                'options' => ['enctype' => 'multipart/form-data']
    ]);
    ?>

    <?= $form->field($model, 'avatar')->widget(CropImageUpload::className()); ?>

    <div class="form-group text-center">
        <?= Html::submitButton(Yii::t('app', 'บันทึก'), ['class' => 'btn btn-success']) ?>

    </div>

    <?php ActiveForm::end(); ?>

    <?php
    $this->registerJs("
$('form#addAvatar').on('submit', function(event){
/*
	var form = $(this);
	$.post(
		form.attr('action'),
		form.serialize()
	).done(function(result){
		if(result == 1){
			form.trigger('reset');
                        */
			$.pjax.reload({container:'#avatar-pjax'});
			$('#modal').modal('hide');
                        /*
		}else{
			alert(result);
		}
	}).fail(function(result){
		alert('server error');
	});
	return false;
        */
});
", View::POS_END);
    ?>
</div>
