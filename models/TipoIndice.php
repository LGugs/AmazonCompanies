<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_indice".
 *
 * @property integer $idTipo_Indice
 * @property string $nome
 * @property string $descricao
 *
 * @property Indice[] $indices
 */
class TipoIndice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo_indice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
        	[['idTipo_Indice'], 'integer'],	
            [['descricao'], 'string'],
            [['nome'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idTipo_Indice' => Yii::t('app', 'Tipo de Índice'),
            'nome' => Yii::t('app', 'Nome'),
            'descricao' => Yii::t('app', 'Descrição'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIndices()
    {
        return $this->hasMany(Indice::className(), ['idTipo_Indice' => 'idTipo_Indice']);
    }
    
    public static function getNome($num){
    	$query = TipoIndice::find()->where(['idTipo_Indice' => $num])->one();
    	return $query->nome;
    }
    
    public static function dropdown(){
    	$models = TipoIndice::find()->all();
    	if($models){
    		foreach ($models as $model){
    			$dropdown[$model->idTipo_Indice] = $model->nome;
    		}
    		return $dropdown;
    	}
    }
}
