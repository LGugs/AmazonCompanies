<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Indice;

/**
 * IndiceSearch represents the model behind the search form about `app\models\Indice`.
 */
class IndiceSearch extends Indice
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
    	return [
    			[['idIndice', 'idTipo_Indice', 'formato'], 'integer'],
    			[['formula', 'nomeIndice'], 'safe'],
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
        $query = Indice::find();

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
        		'idIndice' => $this->idIndice,
        		'idTipo_Indice' => $this->idTipo_Indice,
        		'formato' => $this->formato,
        ]);
        
        $query->andFilterWhere(['like', 'formula', $this->formula])
        ->andFilterWhere(['like', 'nomeIndice', $this->nomeIndice]);
        
        return $dataProvider;
    }
}
