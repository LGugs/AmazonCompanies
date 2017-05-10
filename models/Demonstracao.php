<?php

namespace app\models;

use Yii;
use app\models\Conta;

/**
 * This is the model class for table "demonstracao".
 *
 * @property integer $idDemonstracao
 * @property string $nomeDemonstracao
 * @property integer $contapai
 *
 * @property Conta[] $contas
 */
class Demonstracao extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'demonstracao';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nomeDemonstracao'], 'required'],
            [['contapai', 'ordem'], 'integer'],
            [['nomeDemonstracao'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idDemonstracao' => Yii::t('app', 'Id Demonstracao'),
            'nomeDemonstracao' => Yii::t('app', 'Nome da Demonstração'),
            'contapai' => Yii::t('app', 'Conta Pai'),
        	'ordem' => Yii::t('app', 'Ordem'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContas()
    {
        return $this->hasMany(Conta::className(), ['idDemonstracao' => 'idDemonstracao']);
    }
    
    public static function getNome($num){
    	$query = Demonstracao::find()->where(['idDemonstracao' => $num])->one();
    	return $query->nomeDemonstracao;
    }
    
    //retorna o nome da Conta Pai
    public static function getNomeContaPai($num){
    	if($num == 0){
    		return 'Não Possui';
    	}else{
    		$query = Conta::find()->where(['idConta' => $num])->one();
    		return $query->nome;
    	}
    }
    
    public static function dropdown2(){
    	$models = static::find()->all();
    	if($models){
    		foreach ($models as $model){
    			$dropdown[$model->idDemonstracao] = $model->nomeDemonstracao;
    		}
    		return $dropdown;
    	}
    }
}
