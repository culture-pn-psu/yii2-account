<?php

use yii\helpers\Html;
use yii\helpers\BaseStringHelper;
//use firdows\menu\models\Navigate;
use suPnPsu\material\components\Navigate;
use mdm\admin\components\Helper;

/* @var $this \yii\web\View */
/* @var $content string */

$controller = $this->context;
//$menus = $controller->module->menus;
//$route = $controller->route;
$user = Yii::$app->user->identity->profile->resultInfo;
$module = $this->context->module->id;
?>
<?php $this->beginContent('@app/views/layouts/main.php') ?>

<div class="row">
    <div class="col-md-3">
        <div class="panel panel-default sidebar-menu">

            <div class="panel-heading">
                <h3 class="panel-title">
                    <?= $user->fullname ?>
                </h3>

            </div>

            <div class="panel-body">

                <?php
                $menuItems = [
                        [
                        'label' => 'โปรไฟล์',
                        'url' => ["/{$module}/default/index"], 'icon' => 'fa fa-book'
                    ],
                        [
                        'label' => 'บัญชี',
                        'url' => ["/{$module}/default/setting"],
                        'icon' => 'fa fa-adn'
                    ],
//                    [
//                        'label' => 'Chanage Password',
//                        'url' => ["/{$module}/default/change-password"],
//                        'icon' => 'fa fa-key'
//                    ],
                ];
                $menuItems = Helper::filter($menuItems);

                $nav = new Navigate();
                echo dmstr\widgets\Menu::widget([
                    'options' => ['class' => 'nav nav-pills nav-stacked'],
                    //'linkTemplate' =>'<a href="{url}">{icon} {label} {badge}</a>',
                    'items' => $menuItems,
                ])
                ?>                 

            </div>
            <!-- /.box-body -->
        </div>
        <!-- /. box -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
        <?= $content ?>
        <!-- /. box -->
    </div>
    <!-- /.col -->
</div>


<?php $this->endContent(); ?>
