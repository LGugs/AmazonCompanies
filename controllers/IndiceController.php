<?php

namespace app\controllers;

use Yii;
use app\models\Indice;
use app\models\IndiceSearch;
use app\models\Conta;
use app\models\ContaSearch;
use app\models\EmpresaConta;
use app\models\TipoIndice;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \Fintara\Tools\Calculator\Calculator;
use miloschuman\highcharts\Highcharts;


/**
 * IndiceController implements the CRUD actions for Indice model.
 */
class IndiceController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Indice models.
     * @return mixed
     */
    public function actionIndex()
    {
    	$cont = TipoIndice::find()->select("*")->count(); // verifica se existe algum tipo de indice cadastrado
    	if($cont > 0){
        	$searchModel = new IndiceSearch();
        	$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        	return $this->render('index', [
            	'searchModel' => $searchModel,
            	'dataProvider' => $dataProvider,
        	]);
    	}else{
    		return $this->render('semTipo');
    	}
    }

    /**
     * Displays a single Indice model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Indice model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

         //$indiceP = $_POST['idSelect'];
        // print_r('idSelect');
        // echo '<br>';
        // print_r($indiceP);
    	$ContaSearchModel = new ContaSearch();
    	$ContaDataProvider = $ContaSearchModel->search(Yii::$app->request->queryParams);
    	
        $conta = Conta::find()->select("*")->all();
        $model = new Indice();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idIndice]);
        } else {
            return $this->render('create', [
            	'ContaDataProvider' => $ContaDataProvider,
            	'ContaSearchModel' => $ContaSearchModel,
                'model' => $model,
                'conta' => $conta,
            ]);
        }
    }

    /**
     * Updates an existing Indice model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
    	$ContaSearchModel = new ContaSearch();
    	$ContaDataProvider = $ContaSearchModel->search(Yii::$app->request->queryParams);
    	
    	$conta = Conta::find()->select("*")->all();
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idIndice]);
        } else {
            return $this->render('update', [
            	'ContaDataProvider' => $ContaDataProvider,
            	'ContaSearchModel' => $ContaSearchModel,
            	'conta' => $conta,
                'model' => $model
            ]);
        }
    }
    public function actionCadastrar_indice(){
        //print_r("entrando em pegar");
        $indiceP = $_POST['idSelect'];
        $sinais = ['+', '-', '/', '*', '(', ')'];

        $montarFormulaAnterior = '';
                    $montarFormula='';
        for ($i=0; $i < count($indiceP) ; $i++) { 
            //print_r($indiceP[$i]);
            if(in_array($indiceP[$i],$sinais)){
                //print_r("sinal");
                    $montarFormulaAnterior = ''.$montarFormula.'@';
                    $montarFormula=$montarFormulaAnterior.$indiceP[$i];
            } else{
                 $conta = Conta::find()->select("*")->where(['nome' => $indiceP[$i]])->one();
                $montarFormulaAnterior = ''.$montarFormula.'@';
                    $montarFormula=$montarFormulaAnterior.$conta['chave'];

                //print_r("normal");
            }
            

        }

        print_r($montarFormula);
    }

    public function actionCalc_indice(){

        $empresaP = $_POST['idEmpresa'];
        $indiceP = $_POST['idIndice'];
        
        
        $indice = Indice::find()->select('formula')->where(['idIndice' => $indiceP])->all();
        //$indice = Indice::find()->select('formula')->all();
        $calculator = new Calculator();
        $sinais = ['+', '-', '/', '*', '(', ')'];
        $concatenar='';
        $anterior;
                            
        $anosEmpresas = EmpresaConta::find()->select('ano')->distinct()->orderBy(["ano"=> SORT_ASC])->all();

        foreach($anosEmpresas as $anosEmpresa) {
            print_r("ano: " );
            print_r($anosEmpresa->ano);
            echo '<br>';

            $getChaveContas = preg_split('/[@]/',$indice[0]->formula);
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
                    $empresaConta = EmpresaConta::find()->select("*")->where(['idConta' => $idConta])->andWhere(['ano' =>$anosEmpresa->ano])->andWhere(['idEmpresa' =>$empresaP])->one();
                    if($empresaConta==null){
                        //print_r('@é null@');
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
            print_r($montarFormula);
            print_r(" = ");
            if($verificaSeEhNull==1){
                print_r($concatenar);
                print_r(" = ");

                print_r("-----");
                echo "<br>";


            }else{
             print_r($concatenar);
             print_r(" = ");
             $calculator->setExpression($concatenar);
                      print_r($calculator->calculate());
                      echo '<br>';
         }
        }

        for ($i = 0; $i <= 2; $i++) {
            $field2[$i]['type'] = 'column';
            $field2[$i]['name'] = '201' . $i+4;
            for ($j=0; $j <24 ; $j++) { 
                 $data[$j]= $j+1;

            }
                            $field2[$i]['data'] = $data;


        }
         //print_r(count($categorias));
        //echo '<br>';
        for ($i=0; $i <= 5 ; $i++) { 
            $categorias2[$i]='Ativo Total'.$i;
        }
            

        
        //echo count($resultado);
        //return $tabela;
        echo Highcharts::widget([
   'scripts' => array(
        'modules/exporting',
        'themes/grid-light',
    ),
    'options' => array(
        'title' => array(
            'text' => 'Demonstração',
        ),
        'xAxis' => array(
            'categories' => ['Ativo Total1', 'Ativo Total 2'],
        ),
        
        'series' => //$field2
        array(
            array(
                'type' => 'column',
                'name' => '2014',
                'data' => array(3, 2),
            ),
            array(
                'type' => 'column',
                'name' => '2016',
                'data' => array(2, 3),
            ),
            
        ),
    )
]);

// echo ChartNew::widget([
//   'type'=>'horizontalBar', # pie, doughnut, line, bar, horizontalBar, radar, polar, stackedBar, polarArea
//   'title'=>'PHP Framework',
//   'labels'=>$categorias,
//   'datasets' => $field,
// ]);



    }

    /**
     * Deletes an existing Indice model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Indice model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Indice the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Indice::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}