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

    $tipoEmpresa =  Array('prompt' => 'Selecione...', 'Local'=>'Local','Nacional'=>'Nacional','Estrangeira'=> 'Estrangeira');
    $form = ActiveForm::begin();

    ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'fonte')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo')->dropDownList($tipoEmpresa) ?>

    <?= $form->field($model, 'logotipo')->fileInput(['maxlength' => true])?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Alterar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <h3> DADOS DE CONTAS:
    </h3>
        <div>
            <?= $this->render('_telaBotao', [
                'model' => $model,
                ]) ?>
        </div>
            

    <?php ActiveForm::end(); ?>

</div>












