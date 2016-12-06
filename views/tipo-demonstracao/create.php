<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TipoDemonstracao */

$this->title = 'Create Tipo Demonstracao';
$this->params['breadcrumbs'][] = ['label' => 'Tipo Demonstracaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-demonstracao-create">

    <h4>Criar Novo</h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>