<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "conta".
 *
 * @property integer $idConta
 * @property string $nome
 * @property integer $idDemonstracao
 * @property string $chave
 * @property integer $obrigatorio
 *
 * @property Demonstracao $idDemonstracao0
 * @property EmpresaConta[] $empresaContas
 */
class Conta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'conta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome', 'idDemonstracao', 'chave','formato'], 'required'],
            [['idDemonstracao', 'obrigatorio', 'ordem','pai','formato'], 'integer'],
            [['nome'], 'string', 'max' => 255],
            [['chave'], 'string', 'max' => 30],
            [['idDemonstracao'], 'exist', 'skipOnError' => true, 'targetClass' => Demonstracao::className(), 'targetAttribute' => ['idDemonstracao' => 'idDemonstracao']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idConta' => 'Id Conta',
            'nome' => 'Nome',
            'idDemonstracao' => 'Id Demonstracao',
            'chave' => 'Chave',
            'obrigatorio' => 'Obrigatório',
            'ordem' => 'Ordem',
            'pai' => 'Pai',
            'formato'=>'Formato',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getidDemonstracao0()
    {
        return $this->hasOne(Demonstracao::className(), ['idDemonstracao' => 'idDemonstracao']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpresaContas()
    {
        return $this->hasMany(EmpresaConta::className(), ['idConta' => 'idConta']);
    }
    
    //retorna o nome do pai
    public static function getPai($num){
    	$query = Conta::find()->where(['idConta' => $num])->one();
    	return $query->nome;
    }
    
    public static function dropdown(){
    	$models = static::find()->distinct()->where(['pai' => 0])->all();
    	if($models){
    		foreach ($models as $model){
    			$dropdown[$model->idConta] = $model->nome;
    		}
    		return $dropdown;
    	}
    }
}
