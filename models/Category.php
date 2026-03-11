<?php

namespace app\models;

use yii\db\ActiveRecord;


class Category extends ActiveRecord
{
    public static function tableName()
    {
        return 'category';
    }

    public function rules()
    {
        return [
            [['name'], 'required', 'message' => 'Nazwa kategorii nie może być pusta.'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nazwa kategorii',
        ];
    }
    
    
    public function getProjects()
    {
        return $this->hasMany(Project::class, ['category_id' => 'id']);
    }
}