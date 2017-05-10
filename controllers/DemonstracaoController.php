<?php

namespace app\controllers;

use Yii;
use app\models\Demonstracao;
use app\models\DemonstracaoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Conta;

/**
 * DemonstracaoController implements the CRUD actions for Demonstracao model.
 */
class DemonstracaoController extends Controller
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
     * Lists all Demonstracao models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DemonstracaoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Demonstracao model.
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
     * Creates a new Demonstracao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Demonstracao();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        	if($model->contapai > 0){
        		$conta = Conta::find()->where(['idConta' => $model->contapai])->one();
        		$conta->pai = true;
        		$conta->save();
        	}
            return $this->redirect(['view', 'id' => $model->idDemonstracao]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Demonstracao model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if($model->contapai > 0){ // a conta vai deixar de ser pai
        	$conta = Conta::find()->where(['idConta' => $model->contapai])->one();
        	$conta->pai = false;
        	$conta->save();
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        	if($model->contapai > 0){ // a conta virará pai
        		$conta = Conta::find()->where(['idConta' => $model->contapai])->one();
        		$conta->pai = true;
        		$conta->save();
        	}
            return $this->redirect(['view', 'id' => $model->idDemonstracao]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Demonstracao model.
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
     * Finds the Demonstracao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Demonstracao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Demonstracao::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
