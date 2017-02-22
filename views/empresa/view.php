<?php

    use yii\helpers\Html;
    use yii\helpers\Url;
use yii\helpers\BaseUrl;
    use yii\widgets\DetailView;
    use yii\data\ActiveDataProvider;
    use yii\db\Query;
    use yii\grid\GridView;
    use yii\widgets\ActiveForm;
    use app\models\TipoIndice;
    use app\models\EmpresaConta;
    use app\models\Conta;
    use miloschuman\highcharts\Highcharts;
    use hscstudio\chart\ChartNew;
    use \Fintara\Tools\Calculator\Calculator;
    use \Fintara\Tools\Calculator\DefaultLexer;

    use app\models\Demonstracao;

    use app\models\Indice;
    use app\models\Analise;


use kartik\widgets\FileInput;
use phpnt\bootstrapSelect\BootstrapSelectAsset;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use app\models\Empresa;

use yii\base\Widget;



    /* @var $this yii\web\View */
    /* @var $model app\models\Empresa
     * */

    $this->title = $model->nome;
    $this->params['breadcrumbs'][] = ['label' => 'Empresas', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
    $this->defaultExtension = $model->logotipo
?>

<div class="empresa-view">
    <p>
        <h1>
            <?= Html::a(Html::img('img/'.$this->defaultExtension,  ['style'=>'width:50px']) ) ?>
            <?= Html::encode('Dados da '.$this->title) ?>
            
        </h1>

        
    </p>

    <div class="row">
            <?= Html::button('Gerar PDF', ['id' => 'export_chart', 'class'=> 'btn btn-primary']) ?>
            
            <div class="dropdown col-sm-1">
    			<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" >Ano <span class="caret"></span></button>
    			<ul class="dropdown-menu col-sm-1">
    				<?php
                        foreach($anos as $ano):           
                    ?>
    				<li><a href="#id<?= $ano->ano ?>"><?= $ano->ano ?></a></li> <!--  PRODUZIR FUNÇÃO PARA REALIZAR AS MUDANÇAS NA TABELA -->
    			<?php endforeach; ?>
    			</ul>
    		</div>
    
    </div>
<?php if(Yii::$app->user->getIdentificadorPessoa() == '2' || Yii::$app->user->getIdentificadorPessoa() == '1'){ ?>
     <br>
        <div>
            <?= $this->render('_telaBotao', [
                'model' => $model,
                ]) ?>
        </div>
            <?php }?>
</div>

<div class="body-content">
    <ul class="nav nav-tabs">
    <?php
                        $demonstracoes = Demonstracao::find()->select('*')->all();

                        foreach($demonstracoes as $demonstracao){
     
                    ?>
                    <li><a data-toggle="tab" href="#Demonstracao<?=$demonstracao->idDemonstracao?>"><?=$demonstracao->nomeDemonstracao?></a></li>

                <?php
                        }   
                    ?>

        
        <li><a data-toggle="tab" href="#demoIndice">ÍNDICE</a></li>
        <li><a data-toggle="tab" href="#demoContasObrigatorias">OBRIGATÓRIAS</a></li>

    </ul>

    <div class="tab-content">
        <?php
                        $demonstracoes = Demonstracao::find()->select('*')->all();
                        foreach($demonstracoes as $demonstracao){             
                    ?>
        <div id="Demonstracao<?=$demonstracao->idDemonstracao?>" class="tab-pane fade">
            <div class="container">           
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="check_all" /></th>
                            <th>Nome Conta: <?=$demonstracao->idDemonstracao?></th>
                            <?php
                                            $anosEmpresas = EmpresaConta::find()->select('ano')->distinct()->orderBy(["ano"=> SORT_ASC])->where(['idEmpresa' => $model->idEmpresa])->all();
                                                 $tweets = [['nome'=>'Liquidez', 'id'=>100]];
 
                                                foreach($anosEmpresas as $anosEmpresa){  
                                             ?>
                            <th><?=$anosEmpresa->ano?></th>
                            <?php
                                                }   
                                             ?>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $contas = Conta::find()->select('*')->where(['idDemonstracao' => $demonstracao->idDemonstracao])->all();                                              
                            foreach($contas as $conta){
                                            ?>
                        <tr>
                            <td><input type="checkbox"/></td>
                            <td><?=$conta->nome?></td>
                        
                               <?php
                                            $anosEmpresas = EmpresaConta::find()->select('ano')->distinct()->orderBy(["ano"=> SORT_ASC])->where(['idEmpresa' => $model->idEmpresa])->all();
                                                 $tweets = [['nome'=>'Liquidez', 'id'=>100]];
 
                                                foreach($anosEmpresas as $anosEmpresa){
                                                    $valoress = EmpresaConta::find()->select('valor')->where(['idConta' => $conta->idConta])->andWhere(['ano' =>$anosEmpresa->ano])->andWhere(['idEmpresa' => $model->idEmpresa])->all();
                                                    if(count($valoress)>0){
                                                        foreach($valoress as $valores){

                                             ?>             
                                                    <td>R$ <?=$valores->valor?></td> 
                                                    <?php
                                                        }
                                                    } else{
                                                    ?>             
                                                    <td>-----</td> 
                                                    <?php




                                                    }  
                                                } 
                                    } 
                                             ?>   
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
        <?php
                        }   
                    ?>
         <div id="demoContasObrigatorias" class="tab-pane fade">
            <div class="container">           
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="check_all" /></th>
                            <th>Nome Conta:</th>
                            <?php
                                            $anosEmpresas = EmpresaConta::find()->select('ano')->distinct()->orderBy(["ano"=> SORT_ASC])->where(['idEmpresa' => $model->idEmpresa])->all();
                                                 $tweets = [['nome'=>'Liquidez', 'id'=>100]];
 
                                                foreach($anosEmpresas as $anosEmpresa){  
                                             ?>
                            <th><?=$anosEmpresa->ano?></th>
                            <?php
                                                }   
                                             ?>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $contas = Conta::find()->select('*')->where(['obrigatorio' =>1])->all();                                              
                            foreach($contas as $conta){
                                            ?>
                        <tr>
                            <td><input type="checkbox"/></td>
                            <td><?=$conta->nome?></td>
                        
                               <?php
                                            $anosEmpresas = EmpresaConta::find()->select('ano')->distinct()->orderBy(["ano"=> SORT_ASC])->where(['idEmpresa' => $model->idEmpresa])->all();
 
                                                foreach($anosEmpresas as $anosEmpresa){
                                                    $valoress = EmpresaConta::find()->select('valor')->where(['idConta' => $conta->idConta])->andWhere(['ano' =>$anosEmpresa->ano])->andWhere(['idEmpresa' => $model->idEmpresa])->all();
                                                    if(count($valoress)>0){
                                                        foreach($valoress as $valores){

                                             ?>             
                                                    <td>R$ <?=$valores->valor?></td> 
                                                    <?php
                                                        }
                                                    } else{
                                                    ?>             
                                                    <td>-----</td> 
                                                    <?php




                                                    }  
                                                } 
                                    } 
                                             ?>   
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
        <div id="demoIndice" class="tab-pane fade">
                <div class="container">            
                    <ul class="nav nav-tabs">
                    <?php
                        $tipoIndices = TipoIndice::find()->select('*')->all();
                        $tweets = [['nome'=>'Liquidez', 'id'=>100]];

                        foreach($tipoIndices as $tipoIndice){

                         
                    ?>
                        <li><a data-toggle="tab" href="#Indice<?=$tipoIndice->idTipo_indice?>"><?=$tipoIndice->nome?></a></li>
                        
                        <?php
                        }   
                    ?>
                    </ul>

                    
                </div>
            </div>

            <div class="tab-content">
                    <?php
                        $tipoIndices = TipoIndice::find()->select('*')->all();
                        $tweets = [['nome'=>'Liquidez', 'id'=>100]];

                        foreach($tipoIndices as $tipoIndice){

                         
                    ?>

                        <div id="Indice<?=$tipoIndice->idTipo_indice?>" class="tab-pane fade">
                            <div class="container">            
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                        
                                            <th>Nome:</th>
                                            <th>Fórmula:</th>

                                            <?php
                                            $anosEmpresas = EmpresaConta::find()->select('ano')->distinct()->orderBy(["ano"=> SORT_ASC])->where(['idEmpresa' => $model->idEmpresa])->all();
                                                 $tweets = [['nome'=>'Liquidez', 'id'=>100]];
 
                                                foreach($anosEmpresas as $anosEmpresa){  
                                             ?>
                            <th><?=$anosEmpresa->ano?></th>
                            <?php
                                                }   
                                             ?>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $indices = Indice::find()->select('*')->where(['idTipo_indice' => $tipoIndice->idTipo_indice])->all();

                                                 $sinais = ['+', '-', '/', '*', '(', ')'];
                                                    $calculator = new Calculator();
                                                foreach($indices as $indice){
                                                    $indiceIn = Indice::find()->select('*')->where(['idIndice' => $indice->idIndice])->all();

                                                     $getChaveContas = preg_split('/[ ]/',$indiceIn[0]->formula);
                                                            
                                                            $montarFormulaAnterior = '';
                                                            $montarFormula='';
                                                            for ($i=0; $i <count($getChaveContas); $i++) {
                                                        if(in_array($getChaveContas[$i],$sinais)){                  
                                                            $montarFormulaAnterior = ' '.$montarFormula.' ';
                                                            $montarFormula=$montarFormulaAnterior.$getChaveContas[$i];
                                                        }else{ 
                                                            $conta = Conta::find()->select("*")->where(['chave' => $getChaveContas[$i]])->one();
                                                            $idConta = $conta['idConta'];
                                                        $montarFormulaAnterior = ' '.$montarFormula.' ';
                                                        $montarFormula=$montarFormulaAnterior.$conta['nome'];
                                                        }   
                                                    }
                                            ?>
                                        <tr>
                                        <td><?=$indiceIn[0]->nomeIndice?></td>
                                            <td><?=$montarFormula?></td>
                                            
                                            <?php  
                                                $anosEmpresas = EmpresaConta::find()->select('ano')->distinct()->orderBy(["ano"=> SORT_ASC])->where(['idEmpresa' => $model->idEmpresa])->all();
                                                                        foreach($anosEmpresas as $anosEmpresa) {
                                                                                    $concatenar='';
                                                                                    $anterior='';         
                                                                                    $verificaSeEhNull=0;
                                                                                    $montarFormulaAnterior = '';
                                                                                    $montarFormula='';

                                                                            for ($i=0; $i <count($getChaveContas); $i++) {
                                                                                if(in_array($getChaveContas[$i],$sinais)){
                                                                                    $anterior = $concatenar;
                                                                                    $concatenar = $anterior.$getChaveContas[$i];
                                                                                    $montarFormulaAnterior = ' '.$montarFormula.' ';
                                                                                    $montarFormula=$montarFormulaAnterior.$getChaveContas[$i];

                                                                                }else{ 
                                                                                    $conta = Conta::find()->select("*")->where(['chave' => $getChaveContas[$i]])->one();
                                                                                    $idConta = $conta['idConta'];
                                                                                    $empresaConta = EmpresaConta::find()->select("*")->where(['idConta' => $idConta])->andWhere(['ano' =>$anosEmpresa->ano])->one();
                                                                                    if($empresaConta==null){
                                                                                        $anterior = $concatenar;
                                                                                        $concatenar = $anterior.'xxxx';
                                                                                        $verificaSeEhNull = 1;
                                                                                    } else{
                                                                                        $anterior = $concatenar;
                                                                                    $concatenar = $anterior.$empresaConta['valor'];
                                                                                    }
                                                                                    $montarFormulaAnterior = ' '.$montarFormula.' ';
                                                                                    $montarFormula=$montarFormulaAnterior.$conta['nome'];    
                                                                                }   
                                                                            }
                                                                            if($verificaSeEhNull==1){
                                                                            ?>
                                                                            <td>-----</td> 
                                                                            <?php
                                                                            }else{
                                                                             $calculator->setExpression($concatenar);
                                                                                ?>
                                                                                    <td><?=$calculator->calculate()?></td>
                                                                                      <?php
                                                                         }
                                                                        }

                                                                                                            ?>

                                        </tr>
                                        <?php
                                                }   
                                            ?>
                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php
                        }   
                    ?>
                       
                    </div>

            <script type="application/javascript">
        //Criar controlador acesado vai requisição ajax."
        var keys;
        function comparar(idIndice) {
            console.log("entrou");
               
                    $.ajax({
                        url: '<?php echo Url::to(['indice/calc_indice']);?>',
                        type:'POST',
                        data: {
                            'idEmpresa': <?=$model->idEmpresa?>,
                            'idIndice' : idIndice,
                        },
                        success: function (data) {
                            var $teste = document.querySelector('.wrapper'), novohtml =  data;
                            $teste.insertAdjacentHTML('afterbegin', novohtml);
                        }
                    });
                    $("#teste").trigger('click');
             
        }

        function getIdSelect(){
            console.log('entrou');
            var id_select = $('#id_select').val();
            console.log(id_select);
        }

    </script>

        </div>
    </div>

<div id="analise" class="row">

    <legend>Gráfico</legend> 
    <div id="grafico" style="width: auto; height: auto; margin: 0 auto"></div>

<?php 
echo Highcharts::widget([
   /*
   'scripts' => array(
        'modules/exporting',
        
        //Warning! The use of this component (themes/grid-light) will cause the export to stop working correctly!
        'themes/grid-light',
    ),
    */
    'id' => 'demonstration',
    'options' => array(
        'title' => array(
            'text' => 'Demonstração',
        ),
        'xAxis' => array(
            'categories' => $categorias,
        ),
        
        'series' => $field

    )
]);

 ?> 
 <?php if(Yii::$app->user->getIdentificadorPessoa() == '2' || Yii::$app->user->getIdentificadorPessoa() == '1'){
        					echo '<a href="index.php?r=analise%2Fcreate&idEmpresa=' . $model->idEmpresa . '"><button class="btn btn-primary">Criar Análise</button> </a>';
						}
        	?>
        	<br>
        	<br>
 
 <div class="body-content">
    <ul class="nav nav-tabs">
    <?php
                         $analises = Analise::find()->select('ano')->where(['idEmpresa' => $model->idEmpresa])->orderBy('ano')->all();

                        foreach($analises as $analise){
                         
                    ?>
                    <li><a data-toggle="tab" href="#Analise<?=$analise->ano?>"><?=$analise->ano?></a></li>
                <?php
                        }   
                    ?>
    </ul>
</div> </div>
    <div class="tab-content">
        <?php
                        $analisesanos = Analise::find()->select('*')->where(['idEmpresa' => $model->idEmpresa])->all();
                        foreach($analisesanos as $analiseano){            
                    ?>
        <div id="Analise<?=$analiseano->ano?>" class="tab-pane fade">
            <div class="container">           
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Analise:  </th>
                            
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $analises = Analise::find()->select('texto')->where(['ano' => $analiseano->ano])->andWhere(['idEmpresa' => $model->idEmpresa])->all();                                              
                            foreach($analises as $analise){
                                            ?>
                        <tr>
                            <td><?=$analise->texto?></td>

                            <?php if ($analiseano->investidor == 2){
                                $investidor = 'Comprar';
                                $img = 'compra.jpg';

                            }
                            elseif ($analiseano->investidor == 3) {
                                $investidor = 'Vender';
                                $img = 'venda.jpg';
                            }
                            elseif ($analiseano->investidor == 4) {
                                $investidor = 'Neutro';
                                $img = 'neutro.jpg';
                            }
                            ?>

                            <?php echo '<h5 class="bg-info col-md-3 col-md-offset-2 btn-lg text-center"> Tendências para o investidor: </br> <strong>'. $investidor .'</br></strong>'. Html::img( 'img/'.$img ,['style'=>'width:100px']);' </h5>' ?>

                            <?php if ($analiseano->credor == 2){
                                $credor = 'Emprestar';
                                $img = 'empresta.jpg';

                            }
                            elseif ($analiseano->credor == 3) {
                                $credor = 'Não emprestar';
                                $img = 'nao1.png';

                            }
                            ?>

                            <?php echo '<h5 class="bg-success col-md-3 col-md-offset-2 btn-lg text-center"> Tendências para o credor: </br> <strong> '. $credor .'</br></strong>'. Html::img( 'img/'.$img ,['style'=>'width:100px']);' </h5>' ?>
                               <?php
                                             
                                } 
                            ?>   
                        </tr>
                    </tbody>
                </table>
                <div id = "comentario" class="row">
                    </br>

                    <legend>Deixe seu comentário</legend>

                    <div id="fb-root"></div>
                    <script>(function(d, s, id) {
                      var js, fjs = d.getElementsByTagName(s)[0];
                      if (d.getElementById(id)) return;
                      js = d.createElement(s); js.id = id;
                      js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.8&appId=1866615900285683";
                      fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));</script>
                    <div class="fb-comments" data-href="http://localhost/AmazonCompanies/web/index.php?r=empresa%2Fview&amp;id=1" data-width="100" data-numposts="5"></div>

                    <br>
                    <br>

                    <!-- Posicione esta tag no cabeçalho ou imediatamente antes da tag de fechamento do corpo. -->
                    <script src="https://apis.google.com/js/platform.js" async defer>
                      {lang: 'pt-BR'}
                    </script>

                    <!-- Posicione esta tag onde você deseja que o botão +1 apareça. -->
                    <div class="g-plusone" data-annotation="inline" data-width="300"></div>

                     <div class="modal" id="cadCalIndice" role="dialog">
                            <div class="modal-content">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <?= Html::a('&times;', ['view', 'id' => $model->idEmpresa], ['class' => 'btn close']) ?>
                                        <h3 class="modal-title">Cálculo de Índices</h3>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-inline" role="form">
                                            <div class="wrapper">

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

            </div>
        </div>
    </div>
        <?php
                        }   
                    ?>
	
                

            <script type="application/javascript">
        //Criar controlador acesado vai requisição ajax."
        var keys;
        function comparar(idIndice) {
            console.log("entrou");
               
                    $.ajax({
                        url: '<?php echo Url::to(['indice/calc_indice']);?>',
                        type:'POST',
                        data: {
                            'idEmpresa': <?=$model->idEmpresa?>,
                            'idIndice' : idIndice,
                        },
                        success: function (data) {
                            var $teste = document.querySelector('.wrapper'), novohtml =  data;
                            $teste.insertAdjacentHTML('afterbegin', novohtml);
                        }
                    });
                    $("#teste").trigger('click');
             
        }

        function getIdSelect(){
            console.log('entrou');
            var id_select = $('#id_select').val();
            console.log(id_select);
        }

    </script>

         

<!--
    Savechart (JS part) - Saves a graphic of Highcharts in a .png file on the server

    Author: Pedro Frota <pvmf@icomp.ufam.edu.br>
    Based on canvg: https://github.com/canvg/canvg - Last visit: February 21, 2017
    Since: February 17, 2017
-->

<!-- Required to temporarily save generated .svg -->
<canvas id="canvas" style="display:none;"></canvas>

<?php
    
    //Registering all necessary files
    $this->registerJsFile("lib/savechart/stackblur.js");
    $this->registerJsFile("lib/savechart/rgbcolor.js");
    $this->registerJsFile("lib/savechart/canvg.js");

    /*

    Registering the export function. 

    Note that this code must be written in JavaScript because the Highcharts API is written in 
    JavaScript, and even if the project is using extensions like the one by miloschuman, which 
    allows the code to be fully written in PHP, when the page is rendered, the code is converted 
    to JavaScript. So, the way we used to capture the graph in real time in a simple way, is using 
    JavaScript as well.

    */

    $this->registerJs("
    
    $(function () {
        $(\"#export_chart\").click(function(){
            var svg = document.getElementById('demonstration').children[0].innerHTML;
            canvg(document.getElementById('canvas'),svg);
            var img = canvas.toDataURL(\"image/png\"); //img is data:image/png;base64
            img = img.replace('data:image/png;base64,', '');

            window.open(\"about:blank\", \"showPdf\");

            $.ajax({
              type: \"POST\",
              url: \"index.php?r=empresa/generate_pdf\",
              data: {bin_data: img, name: '".$this->title."'},
              
              success: function(data){
                window.open(data, \"showPdf\");
              }
            });
        });
    });
    
    ");
?>
