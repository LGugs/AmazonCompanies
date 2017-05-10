<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Demonstracao;
use kartik\widgets\TouchSpin;
use app\models\Conta;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model app\models\Conta */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="conta-form">

    <?php $form = ActiveForm::begin(); ?>

   <!--   /* $form->field($model, 'ordem')->widget(TouchSpin::classname(), 
        [
            'options'=>['placeholder'=>'Ordem'],
            'pluginOptions' => 
            [
                'verticalbuttons' => true, 
                'initval' => 1,
                'min' => 1,
                'max' => 1000,
                'verticalupclass' => 'glyphicon glyphicon-plus',
                'verticaldownclass' => 'glyphicon glyphicon-minus',
            ]
        ]);*/
     -->
     <br>

	<?= $form->field($model, 'codigo')->widget(MaskedInput::className(), [
			'mask' => ['9', '9.99', '9.99.99', '9.99.99.99', '9.99.99.99.99', '9.99.99.99.99.99']
	]) ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idDemonstracao')->dropDownList(ArrayHelper::map(Demonstracao::find()->all(), 'idDemonstracao', 'nomeDemonstracao'))->label('Demonstração')?>

	<?= $form->field($model, 'obrigatorio')->dropDownList(['prompt' => 'Selecione...',1 => 'Sim', 0 => 'Não'])->label('Obrigatório?')?>
	
	<?= $form->field($model, 'chave')->textInput(['maxlength' => true]) ?>
	
	<?= $form->field($model, 'pai')->hiddenInput(['value'=> true])->label(false) ?>

    <?= $form->field($model, 'formato')->dropDownList(['prompt' => 'Selecione...',1 => 'R$', 2 => 'USD', 3=> '%', 4=>'Absoluto'])->label('Formato')?>
	
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Criar') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
