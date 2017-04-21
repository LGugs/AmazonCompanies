<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\IndiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Nenhum tipo de índice cadastrado!');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="indice-index">

    <h1><?= Html::encode($this->title) ?></h1>