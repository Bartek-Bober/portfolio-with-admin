<?php

namespace app\models;

use yii\db\ActiveRecord;


class Technology extends ActiveRecord
{
    public static function tableName()
    {
        return 'technology';
    }

    public function rules()
    {
        return [
            [['name', 'icon_class'], 'required', 'message' => 'To pole jest wymagane.'],
            [['name'], 'string', 'max' => 255],
            [['icon_class'], 'string', 'max' => 100],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nazwa technologii (np. PHP)',
            'icon_class' => 'Klasa ikony (np. bi bi-filetype-php)',
        ];
    }

  
    public function getProjects()
    {
        return $this->hasMany(Project::class, ['id' => 'project_id'])
            ->viaTable('project_technology', ['technology_id' => 'id']);
    }
}