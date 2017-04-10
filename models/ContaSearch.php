<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Conta;

/**
 * ContaSearch represents the model behind the search form about `app\models\Conta`.
 */
class ContaSearch extends Conta
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        		[['idConta', 'idDemonstracao', 'obrigatorio','pai', 'formato'], 'integer'],
        		[['codigo'], 'string'],
        		[['nome', 'chave'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Conta::find()->orderBy([
            'idDemonstracao' => SORT_ASC,
            'codigo' => SORT_ASC
        ]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idConta' => $this->idConta,
            'idDemonstracao' => $this->idDemonstracao,
        	'obrigatorio' => $this->obrigatorio,
            'pai'=> $this->pai,
            'formato'=>$this->formato,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])->andFilterWhere(['like', 'chave', $this->chave])->andFilterWhere(['like', 'codigo', $this->codigo]);

        return $dataProvider;
    }


}
