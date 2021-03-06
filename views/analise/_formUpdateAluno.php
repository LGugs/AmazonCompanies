<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\TouchSpin;

/* @var $this yii\web\View */
/* @var $model app\models\Analise */
/* @var $form yii\widgets\ActiveForm */
?>
<script type="text/javascript" src="assets/nicEdit.js"></script>
<script type="text/javascript">
    bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>

<div class="analise-form">

    <?php $form = ActiveForm::begin(); ?>

   <?= $form->field($model, 'investidor')->radioList(
        [
            2 => 'Comprar </br>' . Html::img('img/positivo.jpg',  ['style'=>'width:100px']),
            3 => 'Vender </br>' . Html::img('img/negativo.jpg',  ['style'=>'width:100px']), 
            4 => 'Neutro</br>' . Html::img('img/neutro.png',  ['style'=>'width:100px'])
        ],
        [
            'encode'=> false
        ])->label('<h3>Recomendação ao investidor:</h3>')
    ?>

    <?= $form->field($model, 'credor')->radioList(
        [
            2 => 'Emprestar </br>' . Html::img('img/positivo.jpg',  ['style'=>'width:100px']),
            3 => 'Não emprestar</br>' . Html::img('img/negativo.jpg',  ['style'=>'width:100px'])
        ],
        [
            'encode'=> false
        ])->label('<h3>Recomendação ao credor:</h3>')
    ?>
    <?= $form->field($model, 'ano')->widget(TouchSpin::classname(), 
        [
            'options'=>['placeholder'=>'Ano...'],
            'pluginOptions' => 
            [
                'verticalbuttons' => true, 
                'initval' => intval(date("Y")),
                'min' => 2000,
                'max' => 9999,
                'verticalupclass' => 'glyphicon glyphicon-plus',
                'verticaldownclass' => 'glyphicon glyphicon-minus',
            ]
        ]);
    ?>

    <?= $form->field($model, 'texto')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->hiddenInput(['value'=>'2'])->label(false);//hiddenInput(['value'=>'Pendente']) ?>

     <?= $form->field($model, 'idEmpresa')->hiddenInput()->label(false); ?>

    <?= $form->field($model, 'Usuario_idUsuario')->hiddenInput()->label(false); ?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Submeter' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
