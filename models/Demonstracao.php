<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "demonstracao".
 *
 * @property integer $idDemonstracao
 * @property string $nomeDemonstracao
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
            [['nomeDemonstracao'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idDemonstracao' => 'Id Demonstração',
            'nomeDemonstracao' => 'Nome Demonstração',
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
