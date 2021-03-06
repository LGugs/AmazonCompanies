<?php

namespace app\controllers;

use Yii;
use app\models\Conta;
use app\models\ContaSearch;
use yii\helpers\Json;
use app\models\Demonstracao;
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
        
        if(Yii::$app->request->post('hasEditable')){
        	
        	$id = Yii::$app->request->post('editableKey');
        	$model = Conta::findOne($id);
        	
        	$out = Json::encode(['output' => '', 'message' => '']);
        	
        	$posted = current($_POST['Conta']);
        	$post = ['Conta' => $posted];
        	
        	if($model->load($post)){
        		$model->save();
        		$output = '';
        		$out = Json::encode(['output' => $output, 'message' => '']);
        	}
        	echo $out;
        	return;

        }

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

     




    /**
     * Updates an existing Conta model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		if($model->pai == true){
			if ($model->load(Yii::$app->request->post()) && $model->save()) {
				return $this->redirect(['view', 'id' => $model->idConta]);
			} else {
				return $this->render('updateTrue', [
						'model' => $model,
				]);
			}
		}else{
        	if ($model->load(Yii::$app->request->post()) && $model->save()) {
            	return $this->redirect(['view', 'id' => $model->idConta]);
        	} else {
            	return $this->render('update', [
                	'model' => $model,
            	]);
        	}
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
    /*
    // form com dependencias!!
    public function actionDepender(){
    	$out = [];
    	if(isset($_POST['depdrop_parents'])){
    		$parents = $_POST['depdrop_parents'];
    		if($parents != null){
    			$demo = $parents[0];
    			$out = self::getSubCatList($cat_id);
    			echo Json::encode(['output' => $out, 'selected' => '']);
    			return;
    		}
    	}
    	echo Json::encode(['output' => '', 'selected'=>'']);
    }
    
    public function getSubCatList($id){
    	$temp = Demonstracao::find()->where(['idDemonstracao' => $id])->one();
    	if($temp->nomeDemonstracao == )
    }
    */
}
