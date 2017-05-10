<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\Demonstracao;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DemonstracaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Demonstrações');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="demonstracao-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Criar Demonstração'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'summary' => "",
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
        	'ordem',
            'nomeDemonstracao',
        	[
        		'attribute' => 	'contapai',
        		'value' => function($model,$index,$dataColumn){
        			return Demonstracao::getNomeContaPai($model->contapai);
    			}
    		],
            ['class' => 'kartik\grid\ActionColumn'],
        ],
    ]); ?>
</div>
