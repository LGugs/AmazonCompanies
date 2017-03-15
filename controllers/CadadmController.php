<?php
namespace app\controllers;
use Yii;
use app\models\cadadm;
//use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\CadadmSearch;
/**
 * CadadmController implements the CRUD actions for cadadm model.
 */
class CadadmController extends Controller
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
     * Lists all cadadm models.
     * @return mixed
     */
    public function actionIndex()
    {
   /*     $dataProvider = new ActiveDataProvider([
            'query' => cadadm::find(),
        ]);
       */ 
        $searchModel = new CadadmSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
        	'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Displays a single cadadm model.
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
     * Creates a new cadadm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new cadadm();
		
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        	Yii::$app->mailer->compose()
        	->setFrom('amazoncompaniesbrazil@gmail.com') // inserir outro e-mail!
        	->setTo($model->email)
        	->setSubject('Cadastro no AmazonCompanies realizado com sucesso!')
        	//->setTextBody('Plain text content')
        	->setHtmlBody('<h3><b>Bem vindo Sr(a).' .$model->nome. '</b></h3><br>Você foi cadastrado no site com sucesso. Para acessar sua conta entre com esta senha: ' .$model->senha)
        	->send();
        	cadadm::setSenhaMD5($model); // converte  e salva a senha em md5 para o banco de dados
        	Yii::$app->session->setFlash('success', "Usuário Cadastrado com Sucesso!");
        	return $this->redirect(['/cadadm/create']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Updates an existing cadadm model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idUsuario]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Deletes an existing cadadm model.
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
     * Finds the cadadm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return cadadm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = cadadm::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}