<?php

namespace app\models;

use yii\db\ActiveRecord;

class Skill extends ActiveRecord
{
    public static function tableName() 
    { 
        return 'skill'; 
    }

    public function rules()
    {
        return [
            [['name', 'icon_class'], 'required'],
            [['name', 'icon_class', 'category'], 'string', 'max' => 255],
            [['order_num'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Nazwa technologii (np. PHP)',
            'icon_class' => 'Klasa ikony (np. bi bi-filetype-php)',
            'category' => 'Kategoria (np. Backend)',
            'order_num' => 'Kolejność wyświetlania',
        ];
    }
}