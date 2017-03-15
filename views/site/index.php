<?php

/* @var $this yii\web\View */

use app\models\User;
use app\models\Empresa;
use app\controllers\SiteController;

  $this->title = 'Amazon Companies';
  if (Yii::$app->user->getIsGuest()){
  		$id = Empresa::find()->select('idEmpresa, random() as rand')->orderBy('rand')->limit(1)->one(); // rand() == MYSQL -  random() == POSTGRESQL
		if($id)
			return Yii::$app->response->redirect(['empresa/view', 'id' => $id->idEmpresa]);
		else{
			echo "<h1 align='center'>Não existem empresas cadastradas no momento.<br><br>Entre em contato com o administrador do sistema para maiores informações.</h1>";
		}
  } else{
    $username = Yii::$app->user->identity->nome;
    echo '<h1>Bem Vindo, ' . $username . '!</h1>';
    if(Yii::$app->user->getIdentificadorPessoa() == '1'){
      $this->render('/site/adm');
    }else if(Yii::$app->user->getIdentificadorPessoa() == '2'){
    	$this->render('/site/aluno');
    }else{
    	$this->render('/site/empresa');
    }
  }
  
?>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
