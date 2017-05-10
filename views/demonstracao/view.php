<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Conta;

/* @var $this yii\web\View */
/* @var $model app\models\Demonstracao */

$this->title = $model->nomeDemonstracao;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Demonstrações'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="demonstracao-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Alterar'), ['update', 'id' => $model->idDemonstracao], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Apagar'), ['delete', 'id' => $model->idDemonstracao], [
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
        		'ordem',
            'nomeDemonstracao',
        		[
        				'label' => 'Conta Pai',
        				'value'=> $model->getNomeContaPai($model->contapai)
        		],
        ],
    ]) ?>

</div>
