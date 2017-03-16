<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "empresa_conta".
 *
 * @property integer $id
 * @property integer $ano
 * @property integer $valor
 * @property integer $idEmpresa
 * @property integer $idConta
 * @property integer $idUsuario
 * @property integer $statusValidacao
 *
 * @property Conta $idConta0
 * @property Empresa $idEmpresa0
 * @property Usuario $idUsuario0
 */
class EmpresaConta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'empresa_conta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ano', 'valor', 'idEmpresa', 'idConta', 'idUsuario', 'statusValidacao'], 'required'],
            [['ano', 'valor', 'idEmpresa', 'idConta', 'idUsuario', 'statusValidacao'], 'integer'],
            [['idConta'], 'exist', 'skipOnError' => true, 'targetClass' => Conta::className(), 'targetAttribute' => ['idConta' => 'idConta']],
            [['idEmpresa'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::className(), 'targetAttribute' => ['idEmpresa' => 'idEmpresa']],
            [['idUsuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['idUsuario' => 'idUsuario']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ano' => 'Ano',
            'valor' => 'Valor',
            'idEmpresa' => 'Nome da Empresa',
            'idConta' => 'Id Conta',
            'idUsuario' => 'Id Usuario',
            'statusValidacao' => 'Status Validacao',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdConta0()
    {
        return $this->hasOne(Conta::className(), ['idConta' => 'idConta']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEmpresa0()
    {
        return $this->hasOne(Empresa::className(), ['idEmpresa' => 'idEmpresa']);

        //$query = EmpresaConta::find()->where(['idEmpresa' => ''])->count();
        //return $query;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario0()
    {
        return $this->hasOne(Usuario::className(), ['idUsuario' => 'idUsuario']);
    }

    public static function getNotification(){
        $query = EmpresaConta::find()->where(['statusValidacao' => '2'])->count();
        return $query;
    }
}
