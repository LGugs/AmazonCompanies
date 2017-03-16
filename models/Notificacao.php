<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notificacao".
 *
 * @property integer $idNotificacao
 * @property integer $Usuario_idUsuario
 * @property integer $status
 * @property string $conteudo
 * @property integer $tipo
 * @property integer $idAnalise
 *
 * @property Analise[] $analises
 * @property Usuario $usuarioIdUsuario
 */
class Notificacao extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notificacao';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Usuario_idUsuario', 'status', 'conteudo', 'tipo'], 'required'],
            [['Usuario_idUsuario', 'status', 'tipo', 'idAnalise'], 'integer'],
            [['conteudo'], 'string'],
            [['Usuario_idUsuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['Usuario_idUsuario' => 'idUsuario']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idNotificacao' => Yii::t('app', 'Id Notificacao'),
            'Usuario_idUsuario' => Yii::t('app', 'Usuario Id Usuario'),
            'status' => Yii::t('app', 'Status'),
            'conteudo' => Yii::t('app', 'Texto'),
            'tipo' => Yii::t('app', 'Tipo'),
            'idAnalise' => Yii::t('app', 'Id Analise'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnalises()
    {
        return $this->hasMany(Analise::className(), ['Usuario_idUsuario' => 'Usuario_idUsuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioIdUsuario()
    {
        return $this->hasOne(Usuario::className(), ['idUsuario' => 'Usuario_idUsuario']);
    }
    
    public static function getNotification($id){
    	$query = Notificacao::find()->where(['Usuario_idUsuario' =>$id, 'status' => [0,1,3]])->count();
    	return $query;
    }
}
