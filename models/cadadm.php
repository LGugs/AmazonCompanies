<?php

namespace app\models;

use Yii;

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
class cadadm extends \yii\db\ActiveRecord
{
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
            [['login', 'nome', 'senha', 'ativo', 'identificadorPessoa', 'email',], 'required'],
            [['ativo', 'identificadorPessoa'], 'integer'],
            [['login', 'nome', 'email'], 'string','max' => 45],
        	[['senha'], 'string', 'min' => 8, 'max' => 45],
        	[['matricula'], 'string', 'min' => 8, 'max' => 8],
            [['login', 'email'], 'unique'],
        	[['email'], 'email']
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
            'nome' => 'Nome',
            'senha' => 'Senha',
            'ativo' => 'Status',
            'identificadorPessoa' => 'Tipo',
            'email' => 'Email',
        	'matricula' => 'Matrícula'
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
    public static function setSenhaMD5($model){
    	$model->senha = md5($model->senha);
    	return $model->save();
    }
}
