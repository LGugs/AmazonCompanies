<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TipoIndice */

$this->title = Yii::t('app', 'Alterar {modelClass}: ', [
    'modelClass' => 'Tipo Indice',
]) . $model->idTipo_Indice;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tipo Indices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idTipo_Indice, 'url' => ['view', 'id' => $model->idTipo_Indice]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tipo-indice-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
