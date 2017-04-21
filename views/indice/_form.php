<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use \app\models\Conta;
use \app\models\Indice;
use \app\models\TipoIndice;
use \kartik\grid\GridView;

use kartik\widgets\Select2;
    use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model app\models\Indice */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="indice-form">

    <?php
    $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nomeIndice')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idTipo_Indice')->dropDownList(ArrayHelper::map(TipoIndice::find()->asArray()->all(), 'idTipo_Indice', 'nome'))->label('Tipo do Índice:')?>

    <?= $form->field($model, 'formula')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'formato')->dropDownList(['prompt' => 'Selecione...',1 => 'R$', 2 => 'USD', 3=> '%', 4=>'Absoluto'])->label('Formato')?>
	<td>
    <div class="form-group">
        
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Cadastrar Índice') : Yii::t('app', 'Atualizar'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    	
    	<input value= "Visualizar Contas" class="btn btn-primary" type="button" onclick="if (document.getElementById('conta') .style.display=='none') {document.getElementById('conta').style.display=''; this.innerText = ''; this.value = 'Esconder Contas'; } else { document.getElementById('conta') .style.display='none'; this.innerText = ''; this.value = 'Visualizar Contas'; }"/>
	

    <?php ActiveForm::end(); ?>
    	</div>
	</td>			
</div>

<script type="application/javascript">
        function getIdSelect($element){
            console.log('entrou');
            console.log($element);
            $.ajax({
                        url: '<?php echo Url::to(['indice/cadastrar_indice']);?>',
                        type:'POST',
                        data: {
                            'idSelect': $element
                        },
                        success: function (data) {
                            console.log(data);
                        }
                    });
        }

 </script>
<!-- <div>
    <button id="barra" type="button" onclick="" class="btn btn-default">(</button>

    <button type="button" onclick="" class="btn btn-default">+</button>


    <button type="button" onclick="" class="btn btn-default">-</button>


    <button type="button" onclick="" class="btn btn-default">*</button>
    <button type="button" onclick="" class="btn btn-default">/</button>


    <button type="button" onclick="" class="btn btn-default">)</button>

</div> -->
<br>
<!-- <?php 
$categorias['+'] = '+';
$categorias['-'] = '-';
$categorias['/'] = '/';
$categorias['*'] = '*';


        foreach($conta as $cont){

            $categorias[$cont->nome]=$cont->nome;

        }

echo Select2::widget([
    'class' => 'js-example-basic-multiple',
    'name' => 'color_2',
    'data' => $categorias,
    'maintainOrder' => true,
    'options' => [
	    'class'=>'col-md-3',
	    'id'=>'id_select',
	    'placeholder' => 'Crie a fórmula...', 
	    'multiple' => true
	],
    'pluginOptions' => [
        'tags' => true,
        'maximumInputLength' => 10
    ],
]);
?> -->
<br>
<!-- <div>
    <button type="button" onclick="getIdSelect($('#id_select').val())" class="btn btn-default">Create Indice</button>

</div>
 -->
 
 <div class="conta-index" id="conta"  style="display:none">

    <?= GridView::widget([
        'dataProvider' => $ContaDataProvider,
        'filterModel' => $ContaSearchModel,
        'columns' => [

            'nome',
        		[
        			'attribute' => 	'idDemonstracao0.nomeDemonstracao',
        			'header' => 'Demonstração'
    			],
        		'chave'
           
        ],
    ]); ?>
</div>