<?php

namespace app\models;

use Yii;
use app\models\TipoIndice;

/**
 * This is the model class for table "indice".
 *
 * @property integer $idIndice
 * @property string $formula
 * @property integer $idTipo_Indice
 * @property string $nomeIndice
 * @property integer $formato
 *
 * @property TipoIndice $idTipoIndice
 */
class Indice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'indice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
    	return [
    			[['formula', 'idTipo_Indice', 'formato'], 'required'],
    			[['idTipo_Indice', 'formato'], 'integer'],
    			[['formula', 'nomeIndice'], 'string', 'max' => 255],
    			[['idTipo_Indice'], 'exist', 'skipOnError' => true, 'targetClass' => TipoIndice::className(), 'targetAttribute' => ['idTipo_Indice' => 'idTipo_Indice']],
    	];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idIndice' => Yii::t('app', 'Id Indice'),
            'formula' => Yii::t('app', 'Fórmula'),
            'idTipo_Indice' => Yii::t('app', 'Tipo de Índice'),
            'nomeIndice' => Yii::t('app', 'Nome Indice'),
            'formato' => Yii::t('app', 'Formato'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTipoIndice()
    {
        return $this->hasOne(TipoIndice::className(), ['idTipo_Indice' => 'idTipo_Indice']);
    }
    
    // retorna o formato
    public function formato($model){
    	if($model->formato=='1'){
    		return 'R$';
    	}
    	elseif ($model->formato=='2'){
    		return 'USD';
    	}
    	elseif ($model->formato=='3'){
    		return '%';
    	}
    	else {
    		return 'Absoluto';
    	}
    }
    
    // retorna o nome do tipo de indice
    public function tipoindice($model){
    	$tipo = TipoIndice::find()->where(['idTipo_Indice' => $model->idTipo_Indice])->one();
    	return $tipo->nome;
    }
}
