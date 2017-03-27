<?php

namespace app\controllers;

use Yii;
use app\models\Conta;
use app\models\ContaSearch;
use app\models\Demonstracao;
use app\models\DemonstracaoSearch;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ContaController implements the CRUD actions for Conta model.
 */
class ContaController extends Controller
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
     * Lists all Conta models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Conta model.
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
     * Creates a new Conta model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Conta();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idConta]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

     public function actionBaixar_documento(){

        $contas = Conta::find()->all();

        $titulosColunas = ['Demonstração', 'Nome', 'Valor', 'Ano'];

        $filename = 'templateAmazonCompanies.xlsx';

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
                               $html.='<td><b>'.$demonstracao->nomeDemonstracao.'</b></td>';
                                $html.='<td><b>'.$conta->nome.'</b></td>';
                               
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




    /**
     * Updates an existing Conta model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idConta]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Conta model.
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
     * Finds the Conta model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Conta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Conta::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
