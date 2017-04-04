<?php

namespace app\controllers;

use phpDocumentor\Reflection\Types\Array_;
use Yii;
use app\models\Empresa;
use app\models\EmpresaSearch;
use app\models\EmpresaConta;
use app\models\Conta;
use app\models\Comentario;
use phpoffice\phpexcel\PHPExcel;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\models\UploadForm;
use yii\db\Query;
use yii\db\ActiveQuery;
use moonland\phpexcel\Excel;
use miloschuman\highcharts\Highcharts;
use kartik\mpdf\Pdf;
use app\models\Demonstracao;



/**
 * EmpresaController implements the CRUD actions for Empresa model.
 */
class EmpresaController extends Controller
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
                    'generate_pdf' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Empresa models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EmpresaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @return string
     */

    public function actionCarregado()
    {
    
        return $this->render('view', [
                    'model' => $this->findModel($id),
                    ]);
             
    }

    public function actionGet_descricao(){
    	$contas = Conta::find()->select('*')->all();
    	$i=0;
    	foreach($contas as $conta){
    
    		$categorias[$i]=$conta->nome;
    		$i++;
    
    	}
    	 
    	$anosEmpresas = EmpresaConta::find()->select('ano')->distinct()->orderBy(["ano"=> SORT_ASC])->all();
    	$i=0;
    
    	foreach($anosEmpresas as $anosEmpresa){
    
    		$field[$i]['type'] = 'bar';
    		$field[$i]['name'] = $anosEmpresa->ano;

    			for ($j=0; $j <24 ; $j++) {
    				$data[$j]= $j+1;
    
    			}
    			$field[$i]['data'] = $data;
    			$i++;
    
    
    			}
    }
    /**
     * Displays a single Empresa model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id){
        $comentario = new Comentario();
        $verificaPreenchimento = 1;
        $file = UploadedFile::getInstance($this->findModel($id), 'upload_file');

        if($this->findModel($id)->load(Yii::$app->request->post()) and $file != null){
            $file->saveAs('uploads/'.$file->name);
        	//print_r($file->name);
        
        	$objPHPExcel = new \PHPExcel();
        
        	$inputFileName = './uploads/'.$file->name;  // File to read
        
        	try {
        		$inputFileType = \PHPExcel_IOFactory::identify($inputFileName);
        		$objReader = \PHPExcel_IOFactory::createReader($inputFileType);
        		$objPHPExcel = $objReader->load($inputFileName);
        	} catch(Exception $e) {
        		die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
        	}
        	$cont=1;
        	
        	$sheet = $objPHPExcel->getSheet(0);
        	$highestRow = $sheet->getHighestDataRow();
        	$highestColumn = $sheet->getHighestDataColumn();
        	
        //	$myarray = array_shift($objPHPExcel);

       //     Yii::trace("my array");
      //      Yii::trace($myarray);
       //     Yii::trace(count($myarray));

        	//$idUsuario = Yii::$app->user->getId();
            //Yii::trace($idUsuario);
        for ($row = 2; $row <= $highestRow; $row++) {
        	$rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
        	
        	$model = new EmpresaConta();
        
        	$codigo = $rowData[0][0]; //nome 
        	$conta = Conta::find()->select("*")->where(['codigo' => $codigo])->one();
            Yii::trace("id conta");
        	Yii::trace($conta->idConta);
                        Yii::trace("obrigatorio");

        
            $valor = $rowData[0][3]; // valor
            $ano = $rowData[0][4]; // ano
        	$model->idEmpresa = $id;
            $model->idUsuario = 1;
        	$model->ano = $ano;
        	$model->valor = $valor;
            $model->statusValidacao=0;
        	$model->idConta = $conta->idConta;
            if($conta->obrigatorio==1){
                if($valor!=null){
                    Yii::trace($conta->obrigatorio);
                    ($model->save());
                }else{
                    $verificaPreenchimento=2;
                }

            }else{
                ($model->save());

            }
        
        		 
        	 }
        }
        
        if($verificaPreenchimento==2){
            //mostrar mensagem avisando que não foram cadastrados algumas informações para estava null
        }
      //  $categorias=0;
        $contas = Conta::find()->select('*')->all();
        $i=0;
        foreach($contas as $conta){
        
        	$categorias[$i]=$conta->nome;
        	$i++;
        
        }
         
        $anosEmpresas = EmpresaConta::find()->select('ano')->distinct()->orderBy(["ano"=> SORT_ASC])->where(['idEmpresa' => $id])->all();
        $i=0;
        $contador = 0;
        
        if($anosEmpresas){
        foreach($anosEmpresas as $anosEmpresa){
        
        	$field[$i]['type'] = 'bar';
        	$field[$i]['name'] = $anosEmpresa->ano;
        	
        	for ($j=0; $j <count($contas) ; $j++) {
        		$con = Conta::find()->select('idConta')->where(['nome' => $categorias[$j]])->one();
        		$valore = EmpresaConta::find()->select('valor')->where(['idConta' => $con])->andWhere(['ano' =>$anosEmpresa->ano])->andWhere(['idEmpresa' => $id])->one();
        		if($valore){
        			$data[$j] = $valore->valor;
        			$contador++;
        		}else{
        			$data[$j]= 0;
        		}
        	}
        	
        	$field[$i]['data'] = $data;
        	$i++;
        	}
        }else{ // caso não tenha nenhum dado
        	$field[0]['type'] = 'bar';
        	$field[0]['name'] = 'Sem Dados Cadastrados';
        	$field[0]['data'] = 0;
        }
        		
      $model = $this->findModel($id);

        $comentario->Empresa_idEmpresa = $model->idEmpresa;
        

        if ($comentario->load(Yii::$app->request->post()) && $comentario->save())  {
            return $this->redirect(['view', 'id' => $model->idEmpresa]);
        }
        
        //sessão de variáveis usadas nos foreach na view
        $anos = EmpresaConta::find()->select('ano')->distinct()->orderBy(["ano"=> SORT_ASC])->where(['idEmpresa' => $id])->all();

		
                 return $this->render('view', [
                 	'anos' => $anos,
                    'model' => $this->findModel($id),
                 	'comentario' => $comentario,
                 	'field' => $field,
                 	'categorias' => $categorias,
                 	'contador' => $contador // para tamanho do gráfico
                    ]);
		
        
    }

     public function actionUpdate($id) {
        $model = $this->findModel($id);
        $file = \yii\web\UploadedFile::getInstance($model, 'logotipo');
        $fileArquivo = UploadedFile::getInstance($this->findModel($id), 'upload_file');

        if ($this->findModel($id)->load(Yii::$app->request->post()) && $file != null) {

            $model->logotipo = UploadedFile::getInstance($model, 'logotipo');
            $file->saveAs('img/'.$file->name);

            if($model->save(false)) {
                return $this->redirect(['view', 'id' => $model->idEmpresa]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Creates a new Empresa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate(){
        $model = new Empresa();
        $file = \yii\web\UploadedFile::getInstance($model, 'logotipo');

        if ($model->load(Yii::$app->request->post()) and $file != null){

            $model->logotipo = UploadedFile::getInstance($model, 'logotipo');
            $file->saveAs('img/'.$file->name);

            if($model->save(false)) {
                return $this->redirect(['view', 'id' => $model->idEmpresa]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Updates an existing Empresa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */

     public function actionLoad_documento($id){

        
        $model = new EmpresaConta();

        $objPHPExcel = new Excel();

        $inputFileName = './uploads/documentosTeste.xlsx';  // File to read
        
        try {
           $objPHPExcel = Excel::import($inputFileName);
        } catch(Exception $e) {
           die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
        }
            $cont=1;
           $myarray = array_shift($objPHPExcel);
           
           for ($i = 0; $i < count($myarray); $i++) {
                $model = new EmpresaConta();

                $nome = $myarray[$i]['Nome'];
                $conta = Conta::find()->select("idConta")->where(['nome' => $nome])->one();
                print_r($conta->idConta);

                $valor = $myarray[$i]['Valor'];
                $ano = $myarray[$i]['Ano'];
                $model->idEmpresa = $id;
                $model->ano = $ano;
                $model->valor = $valor;
                
                $model->idConta = $conta->idConta;

               
                $model->save();

               
            }


      

             if($model->save()) {
                 return $this->redirect(['view', 'id' => $idEmpresa]);
             }



    }

   


    /**
     * Deletes an existing Empresa model.
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
     * Finds the Empresa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Empresa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Empresa::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionGenerate_pdf() {
        $data = str_replace(' ', '+', Yii::$app->request->post('bin_data'));
        $name = Yii::$app->request->post('name');
        $data = base64_decode($data);
        
        $img_pre_path = 'temp/savechart/';
        $img_filename = 'chart-export-'.Yii::$app->security->generateRandomString().'.png';

        $pdf_pre_path = "export/empresa/";
        $pdf_filename = $name."-export-".Yii::$app->security->generateRandomString().'.pdf';

        $img_path = $img_pre_path.$img_filename;
        $pdf_path = $pdf_pre_path.$pdf_filename;

        if (!is_dir($img_pre_path)) {
            mkdir($img_pre_path, 0777, true);
        }

        if (!is_dir($pdf_pre_path)) {
            mkdir($pdf_pre_path, 0777, true);
        }

        $im = imagecreatefromstring($data);

        if ($im !== false) {
            // Save image in the specified location
            imagepng($im, $img_path);
            imagedestroy($im);
        }

        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE, 
            // A4 paper format
            'format' => Pdf::FORMAT_A4, 
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT, 
            // stream to browser inline
            'destination' => Pdf::DEST_FILE,
            'filename' => $pdf_path,
            // your html content input
            'content' => 
            '
            <h2 style="text-align: center;">AmazonCompanies</h2>
            <h4 style="text-align: center;">Dados da '.$name.'</h4>
            <br>
            <img src="'.$img_path.'">
            ',  
            //'cssInline' => '', 
             // set mPDF properties on the fly
            'options' => ['title' => $pdf_filename],
             // call mPDF methods on the fly
            'methods' => [ 
                /*
                'SetFooter'=>[''],
                */
            ]
        ]);

        $pdf->render();

        unlink(getcwd().'/'.$img_path);

        echo $pdf_path;
    }

    public function actionBaixar_documento(){
    	
    	$contas = Conta::find()->orderBy([
    			'idDemonstracao' => SORT_ASC,
    			'ordem' => SORT_ASC
    	])->all();
    	
    	$titulosColunas = ['Código', 'Demonstração', 'Nome', 'Valor', 'Ano'];
    	
    	$filename = 'templateAmazonCompanies.xls';
    	
    	$html='
            <html>
                <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                </head>
                <body>
                    <table>
        ';
    	$html.='<tr>';
    	foreach ($titulosColunas as $tituloColuna) {
    		$html.='<td><b>'.$tituloColuna.'</b></td>';
    	}
    	$html.='</tr>';
    	
    	foreach ($contas as $conta) {
    		$demonstracao=Demonstracao::find()->select("nomeDemonstracao")->where(['idDemonstracao' => $conta->idDemonstracao])->one();
    		
    		$html.='<tr>';
    		$html.='<td><b>'.$conta->codigo.'</b></td>';
    		$html.='<td><b>'.$demonstracao->nomeDemonstracao.'</b></td>';
    		$html.='<td>'.$conta->nome.'</td>';
    		
    		$html.='</tr>';
    	}
    	
    	$html.='
                    </table>
                </body>
            </html>
        ';
    	
    	
    	// Forces the browser to download the table
    	header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    	header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
    	header ("Cache-Control: no-cache, must-revalidate");
    	header ("Pragma: no-cache");
    	header ("Content-type: application/x-msexcel");
    	header ("Content-Disposition: attachment; filename=\"{$filename}\"" );
    	header ("Content-Description: Planilha de Contas - AmazonCompanies" );
    	
    	// Sends file content to browser
    	echo $html;
    	
    	
 	
    }
    
}