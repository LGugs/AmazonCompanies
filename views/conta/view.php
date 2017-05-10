<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Conta */

$this->title = $model->idConta;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="conta-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Alterar'), ['update', 'id' => $model->idConta], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Deletar'), ['delete', 'id' => $model->idConta], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Tem certeza de que deseja excluir este item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idConta',
            'nome',
            'idDemonstracao0.nomeDemonstracao',
            'formato',
			'codigo'

        ],
    ]) ?>

</div>
