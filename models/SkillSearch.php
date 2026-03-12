<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Skill;

class SkillSearch extends Skill
{
    public function rules()
    {
        return [
            [['id', 'order_num'], 'integer'],
            [['name', 'icon_class', 'category'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = Skill::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['category' => SORT_ASC, 'order_num' => SORT_ASC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'order_num' => $this->order_num,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
              ->andFilterWhere(['like', 'icon_class', $this->icon_class])
              ->andFilterWhere(['like', 'category', $this->category]);

        return $dataProvider;
    }
}