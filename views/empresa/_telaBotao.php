<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Empresa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="empresa-form">


    <?php

       
        $form = ActiveForm::begin();

    ?>

    
    <?= $form->field($model, 'upload_file')->fileInput(['maxlength' => true])->label('Inserir Dados:')?>
    <?php
        //echo FileInput::widget([
          //  'name' => 'logotipo',
            //]);
    ?>
    <div class="form-group">
        <div class="form-group">
        <?= Html::submitButton('Carregar Dados', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Baixar Template'), ['baixar_documento'], ['class' => 'btn btn-default']) ?>
        </h1>
    </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
