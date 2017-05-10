<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Demonstracao */

$this->title = Yii::t('app', 'Criar Demonstração');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Demonstrações'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="demonstracao-criar">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
