<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TipoIndice */

$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tipo Indices'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-indice-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Alterar'), ['update', 'id' => $model->idTipo_Indice], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Deletar'), ['delete', 'id' => $model->idTipo_Indice], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Tem certeza de que deseja excluir este item?'),
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(Yii::t('app', 'Voltar'), ['create'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'descricao',
        ],
    ]) ?>

</div>
