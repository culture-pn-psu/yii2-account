<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use karpoff\icrop\CropImageUpload;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model culturePnPsu\user\models\Profile */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
$this->registerCss("

.widget-user .widget-user-header{
    position: relative;
    background-size: cover;
    background-position: 50% 50%;
    background-repeat: no-repeat;
    
    padding: 20px;
    height: 120px;
    border-top-right-radius: 3px;
    border-top-left-radius: 3px;
}
.widget-user .widget-user-header{
    height: 200px;
}
.widget-user .widget-user-image{
    top: 145px;
    position: absolute;
    left: 50%;
    margin-left: -45px;
}

.widget-user .widget-user-image img {
    width: 90px;
    height: auto;
    border: 3px solid #fff;
}

.widget-user .btn-change-photo{
    position: absolute;
    right: 15px;
    bottom: 15px;
    display: none;
}
.widget-user .widget-user-image:hover .btn-change-photo,
.widget-user .widget-user-header:hover .btn-change-photo{
    display: inherit;
}
.widget-user .modal-change-photo input[type=\"file\"]{
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;
}
");
?>

<div class="profile-form">

    <div class="box box-widget widget-user">

        <!-- Add the bg color to the header using any of the bg-* classes -->
        <?php Pjax::begin(['id' => 'cover_pjax']) ?>
        <div class="widget-user-header bg-black" style="background-image: url('<?= $model->resultInfo->cover; ?>');">
            <div style="color: #333">
                 <button type="button" data-toggle="modal" data-target="#modal_cover" class="btn btn-default btn-change-photo"><i class="fa fa-picture-o" aria-hidden="true"></i></button>    
            </div>
        </div>
        <?php Pjax::end(); ?>
        
        
        <div class="widget-user-image">
            <?php Pjax::begin(['id' => 'avatar_pjax']) ?>
            <img class="img-circle" src="<?= $model->resultInfo->avatar; ?>" alt="User Avatar">
            <?php Pjax::end() ?>




            <div style="color: #333">
                <button type="button" data-toggle="modal" data-target="#modal_avatar" class="btn btn-default btn-change-photo"><i class="fa fa-picture-o" aria-hidden="true"></i></button>
            </div>


        </div>



        <?php 
        Pjax::begin(['id' => 'profile_pjax','timeout'=>3000]);
        $form = ActiveForm::begin(['options' => ['data-pjax' => true]]); ?>

        <div class="box-footer">
            <div class="row" style="margin-top: 30px;">
                <div class="col-sm-12">

                    <div class="row">
                        <div class="col-sm-6">
                            <?= $form->field($model, 'firstname')->textInput(['maxlength' => true, 'readonly' => true]) ?>
                        </div>
                        <div class="col-sm-6">
                            <?= $form->field($model, 'lastname')->textInput(['maxlength' => true, 'readonly' => true]) ?>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-6">
                            <?= $form->field($person, 'tel')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-sm-6">
                            <?= $form->field($person, 'address')->textarea() ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>

                    <!-- /.description-block -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        
        <?php
        
        ActiveForm::end(); 
        Pjax::end(); 
        ?>


    </div>



</div>


<?php 
### Avatar ##
Pjax::begin(['id' => 'update_avatar']);
Modal::begin([
    'id' => 'modal_avatar',
    'header' => '<h4 class="modal-title">Change Cover</h4>',
    'options' => [
        'class' => 'modal-change-photo',
    ],
//    'toggleButton' => [
//        'label' => '<i class="fa fa-picture-o" aria-hidden="true"></i>',
//        'class' => 'btn btn-default btn-change-photo'
//    ],
     //'footer' => Html::submitButton('<i class="fa fa-check-circle-o" aria-hidden="true"></i> Update', ['class' => 'btn btn-primary']),
]);

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'data-pjax' => true]]);
echo $form->field($model, 'avatar')->widget(CropImageUpload::className(), [
    'url' => "/uploads/user/{$model->resultInfo->id}/avatars"
]);
echo Html::submitButton('<i class="fa fa-check-circle-o" aria-hidden="true"></i> Update', ['class' => 'btn btn-primary update_modal_avatar']);

ActiveForm::end();
Modal::end();
Pjax::end(); 
?>
<?php 
### Cover ##
Pjax::begin(['id' => 'update_cover']);
Modal::begin([
    'id' => 'modal_cover',
    'header' => '<h4 class="modal-title">Change Cover</h4>',
    'options' => [
        'class' => 'modal-change-photo',
    ],
//    'toggleButton' => [
//        'label' => '<i class="fa fa-picture-o" aria-hidden="true"></i>',
//        'class' => 'btn btn-default btn-change-photo'
//    ],
     //'footer' => Html::submitButton('<i class="fa fa-check-circle-o" aria-hidden="true"></i> Update', ['class' => 'btn btn-primary']),
]);

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'data-pjax' => true]]);
echo $form->field($model, 'cover')->widget(CropImageUpload::className(), [
    'url' => "/uploads/user/{$model->resultInfo->id}/covers"
]);
echo Html::submitButton('<i class="fa fa-check-circle-o" aria-hidden="true"></i> Update', ['class' => 'btn btn-primary update_modal_cover']);

ActiveForm::end();
Modal::end();
Pjax::end(); 
?>

<?php
$this->registerJs(
'$("document").ready(function(){ 
    
    $("#update_avatar").on("pjax:end", function() {
        $.pjax.reload({container:"#avatar_pjax"});  //Reload GridView
        $("#modal_avatar").modal("hide");
        $("body").removeClass("modal-open");
        $(".modal-backdrop").remove();
    });
    
    $("#update_cover").on("pjax:end", function() {
        $.pjax.reload({container:"#cover_pjax"});  //Reload GridView
        $("#modal_cover").modal("hide");
        $("body").removeClass("modal-open");
        $(".modal-backdrop").remove();
    });
        


});'
        , yii\web\View::POS_END);
?>

