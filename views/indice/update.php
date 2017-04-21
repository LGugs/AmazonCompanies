<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Indice */

$this->title = Yii::t('app', 'Atualizar {modelClass}: ', [
    'modelClass' => 'Indice',
]) . $model->nomeIndice;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Indices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idIndice, 'url' => ['view', 'id' => $model->idIndice]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="indice-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    	'ContaSearchModel' => $ContaSearchModel,
    	'ContaDataProvider' => $ContaDataProvider,
    	'conta' => $conta,
        'model' => $model
    ]) ?>

</div>