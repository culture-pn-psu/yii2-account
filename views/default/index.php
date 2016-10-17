<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel suPnPsu\account\models\AccountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'โปรไฟล์');
$this->params['breadcrumbs'][] = $this->title;
?>



<?=
$this->render('_form', [
    'model' => $model,
    'person' => $person,
])
?>


