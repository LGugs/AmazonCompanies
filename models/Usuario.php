<?php

namespace app\models;

use Yii;
use kartik\password\StrengthValidator;

/**
 * This is the model class for table "usuario".
 *
 * @property integer $idUsuario
 * @property string $login
 * @property string $nome
 * @property string $senha
 * @property integer $ativo
 * @property integer $identificadorPessoa
 * @property string $email
 *
 * @property Comentario[] $comentarios
 * @property EmpresaHasUsuario[] $empresaHasUsuarios
 * @property Empresa[] $empresaIdEmpresas
 * @property Notificacao[] $notificacaos
 */
class Usuario extends \yii\db\ActiveRecord
{
	public $repetir_senha;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['login', 'nome', 'senha', 'repetir_senha', 'ativo', 'identificadorPessoa', 'email',], 'required'],
            [['ativo', 'identificadorPessoa'], 'integer'],
            [['login', 'nome', 'senha', 'repetir_senha', 'email'], 'string', 'max' => 45],
        	[['senha', 'repetir_senha'], 'string', 'min' => 8 ],
        	[['matricula'], 'string', 'min' => 8, 'max' => 8],
            [['login', 'email'], 'unique'],
        	[['email'], 'email'],
        	['repetir_senha', 'compare', 'compareAttribute'=>'senha', 'message'=>"Senha inserida não é igual a anterior" ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idUsuario' => 'Id Usuario',
            'login' => 'Login',
            'nome' => 'Usuário',
            'senha' => 'Senha',
            'ativo' => 'Ativo',
            'identificadorPessoa' => 'Tipo',
            'email' => 'Email',
            'matricula' => 'Matrícula',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComentarios()
    {
        return $this->hasMany(Comentario::className(), ['Usuario_idUsuario' => 'idUsuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpresaHasUsuarios()
    {
        return $this->hasMany(EmpresaHasUsuario::className(), ['Usuario_idUsuario' => 'idUsuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpresaIdEmpresas()
    {
        return $this->hasMany(Empresa::className(), ['idEmpresa' => 'Empresa_idEmpresa'])->viaTable('empresaHasUsuario', ['Usuario_idUsuario' => 'idUsuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotificacaos()
    {
        return $this->hasMany(Notificacao::className(), ['Usuario_idUsuario' => 'idUsuario']);
    }
    
    // converte a senha basica para uma encriptografada e salva no bd
    public function setSenhaMD5($model){
    	$model->senha = md5($model->senha);
    	$model->repetir_senha = md5($model->repetir_senha);
    	return $model->save();
    }
    
    // retorna a quantidade de status pendentes
    public static function getNotification(){
    	$query = Usuario::find()->where(['ativo' => '2'])->count();
    	return $query;
    }
}
