<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Indice */

$this->title = $model->nomeIndice;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Indices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="indice-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Atualizar'), ['update', 'id' => $model->idIndice], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Apagar'), ['delete', 'id' => $model->idIndice], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'formula',
        	[
        		'label' => 'Tipo de Índice',
        		'value'=> $model->tipoindice($model)
    		],
            [
            	'label' => 'Formato',
                'value'=> $model->formato($model)
            ],
        ],
    ]) ?>

</div>

