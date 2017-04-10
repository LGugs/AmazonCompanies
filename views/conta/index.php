<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\Conta;
use app\models\Demonstracao;
use yii\widgets\MaskedInput;
use yii\base\Widget;
use kartik\editable\Editable;

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
        
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
    	'pjax' => true,
        'columns' => [
          //  'ordem',
			//'codigo',
			[
					'class' => 'kartik\grid\EditableColumn',
					'attribute' => 'codigo'
			],
            'nome',
        		[
        			'attribute' => 	'idDemonstracao',
        			'value' => function($model,$index,$dataColumn){
        				return Demonstracao::getNome($model->idDemonstracao);
        			},
    				'filter' => Demonstracao::dropdown2()
    			],
            
        		[
        		'attribute' => 'obrigatorio',
        		'hAlign' => 'center',
        		'value' => function($model, $index, $dataColumn) {
        		if($model->obrigatorio == '1'){
        			return 'Sim';
        		}else if($model->obrigatorio == '0'){
        			return 'Não';
        		}else{
        			return 'Não Aplicado';
        		}
        		},
        		'filter' => [
        				'1' => 'Sim',
        				'0' => 'Não'
        		]
        		],
            ['attribute'=>'formato',
                'value'=> function($model, $index, $dataColumn){
                    if($model->formato=='1'){
                        return 'R$';
                    }
                    elseif ($model->formato=='2'){
                        return 'USD';
                    }
                    elseif ($model->formato=='3'){
                        return '%';
                    }
                    else {
                        return 'Absoluto';
                    }
                }
            ],
            [
            		'attribute' => 'pai',
            		'value' => function($model){
            			if($model->pai == 0){
            				return 'Não Possui';
            			}else{
            				return Conta::getPai($model->pai);
            			}
            		},
            		'filter' => [
            			'0' => 'Não Possui',
            			'Pais Existentes:' => Conta::dropdown()
            		]
            ],

            ['class' => 'kartik\grid\ActionColumn'],
        ],
    ]); ?>
</div>
