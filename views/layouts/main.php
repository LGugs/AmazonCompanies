<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\User;
use app\models\Analise; 
use app\models\Usuario;
use app\models\Notificacao;
use app\models\EmpresaConta;
use app\models\Rodape;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title)?></title>
    <?php $this->head() ?>
    <style>
        .nav > li > form > button.logout:focus,
        .nav > li > form > button.logout:hover {
            text-decoration: none;
        }
        .nav > li > form > button.logout:focus {
            outline: none;
        }
        .navbar .nav > li > a {
            color: white;
        }
        .nav .open > a
        {
            background:green;
        }
        .navbar .navbar-nav .navbar-right .brand, .navbar .nav > li > a:hover {
            background: #0d6aad;
            color: white;
        }
        .navbar-inverse .navbar-right .navbar-nav>.active>a:hover {
            background: #0d6aad;
            color: white;
        }
        .navbar-inverse .navbar-right .navbar-nav > .active > a, .navbar-inverse .navbar-nav > .active > a:hover, .navbar-inverse .navbar-nav > .active > a:focus{
            background: #0d6aad;
            color: white;
        }
        .navbar-inverse {
            background-color: #001a35;
            border-color: #001a35;
            background: linear-gradient(to right,  #001a35 , #0d6aad,  #001a35);
        }
        }
    </style>

</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    // contador de notificações
    $not_aluno = Notificacao::getNotification(Yii::$app->user->getId());
    
    // notificações para adms
    $not_adm_analise =  Analise::getNotification();
    $not_adm_cadastro = Usuario::getNotification();
    $not_adm_alt_dados = EmpresaConta::getNotification();
    $not_adm_total = $not_adm_alt_dados + $not_adm_analise + $not_adm_cadastro;
    
    
    NavBar::begin([
        'brandLabel' => 'Amazon Companies',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
            ['class' =>'nav navbar-nav'],
            
        ],
    ]);
    
    if(Yii::$app->user->getIdentificadorPessoa() == '1'){ //Administrador
        echo Nav::widget([
                'encodeLabels' => false,
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                        ['label' => 'Página Inicial', 'url' => ['/site/adm']],
                        ['label' => 'Empresas', 'url' => ['empresa/index']],
                        ['label' => 'Cadastro',
                        'items' =>[
                                        ['label' => 'Contas', 'url' => ['conta/index']],
                                        ['label' => 'Demonstrações', 'url' => ['demonstracao/index']],
                                        ['label' => 'Índices', 'url' => ['indice/index']],
                            ['label' => 'Tipo de índices', 'url' => ['tipo-indice/index']],
                                        ['label' => 'Links', 'url' => ['rodape/index']],
                                  ]
                        ],
                        ['label' => 'Usuários',
                        'items' => [
                        ['label' => 'Cadastrar', 'url' => ['/cadadm/create']],
                                //'<li class="divider"></li>',
                                //'<li class="dropdown-header">Dropdown Header</li>',
                                ['label' => 'Listar', 'url' => ['/cadadm/']],
                        ]],
                        ['label' => 'Notificações '. Html::tag('span', $not_adm_total, ['class' => 'badge']), // configurar para que o o botão, ao ser clicado abra as notificações e ao passar o mouse acima, exiba o dropdown
                        'items' => [
                                ['label' => Html::tag('span', $not_adm_analise, ['class' => 'badge']).' Análises', 'url' => ['/analise/index']],
                                //'<li class="divider"></li>',
                                //'<li class="dropdown-header">Dropdown Header</li>',
                                ['label' => Html::tag('span', $not_adm_alt_dados, ['class' => 'badge']).' Alteração de Dados', 'url' => ['/empresa-conta/index']],
                                ['label' => Html::tag('span', $not_adm_cadastro, ['class' => 'badge']).' Cadastro', 'url' => ['/usuario/']],
                        ]],
                        ['label' => 'Seu Perfil', 'url' => ['/usuario/update', 'id' => Yii::$app->user->getId()]], 
                        Yii::$app->user->isGuest ? (
                                ['label' => 'Entrar', 'url' => ['/site/login']]
                                ) : (
                                        '<li>'
                                        . Html::beginForm(['/site/logout'], 'post')
                                        . Html::submitButton(                                                                                                                                                                                                                                                        
                                                'Sair (' . Yii::$app->user->identity->nome . ')',
                                                ['class' => 'btn btn-link logout']
                                                )
                                        . Html::endForm()
                                        . '</li>'
                                        )
                ],
        ]);
    }else if (Yii::$app->user->getIdentificadorPessoa() == '2'){ //Aluno
        echo Nav::widget([
        'encodeLabels' => false,
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                        ['label' => 'Página Inicial', 'url' => ['/site/aluno']],
                        ['label' => 'Empresas', 'url' => ['/empresa/index']],
                        ['label' => 'Notificações '. Html::tag('span', $not_aluno, ['class' => 'badge']), 'url' => ['/notificacao/']],
                        ['label' => 'Seu Perfil', 'url' => ['/usuario/update', 'id' => Yii::$app->user->getId()]],
                        ['label' => 'Contato', 'url' => ['/site/contact']],
                        ['label' => 'Sobre', 'url' => ['/site/about']],
                         
                        Yii::$app->user->isGuest ? (
                                ['label' => 'Entrar', 'url' => ['/site/login']]
                                ) : (
                                        '<li>'
                                        . Html::beginForm(['/site/logout'], 'post')
                                        . Html::submitButton(
                                                'Sair (' . Yii::$app->user->identity->nome . ')',
                                                ['class' => 'btn btn-link logout']
                                                )
                                        . Html::endForm()
                                        . '</li>'
                                        )
                ],
        ]);
    }else if (Yii::$app->user->getIdentificadorPessoa() == '3'){ //Empresa
        echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                        ['label' => 'Página Inicial', 'url' => ['/site/empresa']],
                        ['label' => 'Empresas',
                        'items' =>[
                                ['label' => 'Cadastrar Informações', 'url' => ['/site/cadinfoemp']],
                                ['label' => 'Listar Empresas Cadastradas', 'url' => ['empresa/index']],
                        ]],
                        ['label' => 'Seu Perfil', 'url' => ['/usuario/update', 'id' => Yii::$app->user->getId()]],
                        ['label' => 'Contato', 'url' => ['/site/contact']],
                        ['label' => 'Sobre', 'url' => ['/site/about']],
                        
                        
                        Yii::$app->user->isGuest ? (
                                ['label' => 'Entrar', 'url' => ['/site/login']]
                                ) : (
                                        '<li>'
                                        . Html::beginForm(['/site/logout'], 'post')
                                        . Html::submitButton(
                                                'Sair (' . Yii::$app->user->identity->nome . ')',
                                                ['class' => 'btn btn-link logout']
                                                )
                                        . Html::endForm()
                                        . '</li>'
                                        )
                ],
        ]);
    }else{ // Visitante
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                
                ['label' => 'Empresas', 'url' => ['/empresa/index']],
                ['label' => 'Contato', 'url' => ['/site/contact']],
                ['label' => 'Sobre', 'url' => ['/site/about']],
                
                Yii::$app->user->isGuest ? (
                    ['label' => 'Entrar', 'url' => ['/site/login']]
                ) : (
                    '<li>'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(
                        'Sair (' . Yii::$app->user->identity->nome . ')',
                        ['class' => 'btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
                )
            ],
        ]);
    }
    
    NavBar::end();
    ?>


    <div class="container">
        
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>


<?php $this->endBody() ?>
</body>
</html>
    
<?php $this->endPage() ?>

 
        
<div id="footerIn" style="" class="ui-state-focus" style="padding:5px; clear:both;" align="center">
    <li class="list-group-item list-group-item-info">
        
        <a href="http://www.ufam.edu.br">
            <span style="float:none;">
                <img style="height:90px; vertical-align:middle" class="iconDetails" src="img/ufam.jpg" alt=""/>
            </span>
        </a>
        <br/>
        <a href="http://www.fes.ufam.edu.br/">
            <span style="float:none;">
                
                FES - Faculdade de Estudos Sociais
            </span>
        </a>
        <br/>
         <a href="http://www.ufam.edu.br">
            <span style="float:none;" >
               
                Universidade Federal Do Amazonas
            </span>
        </a>
        <br/>

        <!--  -->

        © Coordenação de Sistemas - UFAM </br>
        <?php
        $rodape = Rodape::findOne(1);
		
        $link = $rodape->link;
        echo "$link";
        ?>
        <br/>

        <?php
        $rodape = Rodape::findOne(2);

        $link = $rodape->link;
        echo "$link";
        ?>
        <br/>

        <?php
        $rodape = Rodape::findOne(3);

        $link = $rodape->link;
        echo "$link";
        ?>
        <br/>

    </li>


</div>
