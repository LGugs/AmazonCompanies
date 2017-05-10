<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Demonstracao;

/**
 * DemonstracaoSearch represents the model behind the search form about `app\models\Demonstracao`.
 */
class DemonstracaoSearch extends Demonstracao
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idDemonstracao', 'ordem'], 'integer'],
            [['nomeDemonstracao'], 'safe'],
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
        $query = Demonstracao::find()->orderBy([
        		'ordem' => SORT_ASC
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
            'idDemonstracao' => $this->idDemonstracao,
        	'ordem' => $this->ordem
        ]);

        $query->andFilterWhere(['like', 'nomeDemonstracao', $this->nomeDemonstracao]);

        return $dataProvider;
    }
}
