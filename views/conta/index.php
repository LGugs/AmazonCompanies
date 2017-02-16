<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ContaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Contas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="conta-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php
        if(Yii::$app->user->getIdentificadorPessoa() == '1'){
            ?>
        <?= Html::a(Yii::t('app', 'Criar Conta'), ['create'], ['class' => 'btn btn-success']) ?>
            <?php
        }
        ?>


        <?= Html::a(Yii::t('app', 'Baixar Template'), ['baixar_documento'], ['class' => 'btn btn-default']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'nome',
            'idDemonstracao0.nomeDemonstracao',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
