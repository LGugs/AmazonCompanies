<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Notificacao */

$this->title = Yii::t('app', 'Criar Notificacao');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Notificacaos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notificacao-criar">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
