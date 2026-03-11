<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Project extends ActiveRecord
{
    // Wirtualne pole na zaznaczone technologie z formularza
    public $technology_ids = []; 

    public static function tableName()
    {
        return 'project';
    }

    /**
     * Zasady walidacji danych przed zapisem.
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [['description'], 'string'],
            
            
            [['title', 'image_url', 'github_url', 'live_url'], 'string', 'max' => 255],
            
            
            [['category_id'], 'integer'],
            [['technology_ids'], 'safe'], 
        ];
    }

    /**
     * Etykiety wyświetlane w formularzach i tabelach.
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Tytuł projektu',
            'description' => 'Opis realizacji',
            'category_id' => 'Kategoria',
            'technology_ids' => 'Wykorzystane technologie',
            'image_url' => 'Adres URL miniatury (link do zdjęcia)',
            'github_url' => 'Link do GitHuba',
            'live_url' => 'Link do wersji Live',
        ];
    }

    // ==========================================
    // RELACJE Z BAZĄ DANYCH
    // ==========================================

    // Projekt ma jedną kategorię
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    // Projekt ma wiele technologii
    public function getTechnologies()
    {
        return $this->hasMany(Technology::class, ['id' => 'technology_id'])
            ->viaTable('project_technology', ['project_id' => 'id']);
    }
    
    // ==========================================
    // ZAPISYWANIE TECHNOLOGII PO ZAPISIE PROJEKTU
    // ==========================================

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        // 1. Najpierw czyścimy stare powiązania (ważne przy edycji projektu)
        \Yii::$app->db->createCommand()
            ->delete('project_technology', ['project_id' => $this->id])
            ->execute();

        // 2. Jeśli zaznaczono jakieś technologie w formularzu, zapisujemy je w tabeli łącznikowej
        if (is_array($this->technology_ids) && !empty($this->technology_ids)) {
            $dataToInsert = [];
            
            foreach ($this->technology_ids as $tech_id) {
                // Tworzymy pary: [ID Projektu, ID Technologii]
                $dataToInsert[] = [$this->id, (int)$tech_id];
            }
            
            // Masowo wrzucamy wszystkie powiązania do bazy
            \Yii::$app->db->createCommand()
                ->batchInsert('project_technology', ['project_id', 'technology_id'], $dataToInsert)
                ->execute();
        }
    }
}