<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "analise".
 *
 * @property integer $idanalise
 * @property string $texto
 * @property integer $status
 * @property integer $idEmpresa
 *
 * @property Empresa $idEmpresa0
 */
class Analise extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'analise';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status','texto'], 'string'],
            [['idEmpresa'], 'required'],
            [[ 'idEmpresa', 'ano', 'investidor', 'credor'], 'integer'],
            [['idEmpresa'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::className(), 'targetAttribute' => ['idEmpresa' => 'idEmpresa']],
            [['Usuario_idUsuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['Usuario_idUsuario' => 'idUsuario']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idanalise' => 'Idanalise',
            'texto' => 'Texto',
            'status' => 'Status',
            'ano' => 'Ano',
            'investidor' => 'Investidor',
            'credor' => 'Credor',
            'idEmpresa' => 'Empresa',
            'Usuario_idUsuario' => 'Usuário'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEmpresa0()
    {
        return $this->hasOne(Empresa::className(), ['idEmpresa' => 'idEmpresa']);
    }

    public function getUsuarioIdUsuario()
    {
        return $this->hasOne(Usuario::className(), ['idUsuario' => 'Usuario_idUsuario']);
    }
    
    // retorna a quantidade de status pendentes
    public static function getNotification(){
        $query = Analise::find()->where(['status' => '2'])->count();
        return $query;
    }

    public function getNotificacaos()
    {
        return $this->hasMany(Notificacao::className(), ['Usuario_idUsuario' => 'idUsuario']);
    }
}
