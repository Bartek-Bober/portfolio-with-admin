<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Html;

/**
 * To jest główny model Twoich projektów.
 * Obsługuje zapis do bazy danych oraz dostarcza ikony technologii.
 */
class Project extends ActiveRecord
{
    /**
     * Powiązanie z tabelą w bazie danych.
     */
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
            [['title', 'technologies', 'image_url', 'link'], 'string', 'max' => 255],
            // 'safe' pozwala na masowe przypisanie tablicy z checkboxów przed konwersją.
            ['technologies', 'safe'], 
        ];
    }

    /**
     * TWOJE CENTRUM IKON I KOLORÓW.
     * Tutaj definiujemy, jak wygląda każda technologia w systemie.
     */
    public static function getTechList()
    {
        return [
            'HTML'      => ['icon' => 'bi-filetype-html', 'color' => '#E34F26'],
            'CSS'       => ['icon' => 'bi-filetype-css',  'color' => '#1572B6'],
            'JS'        => ['icon' => 'bi-filetype-js',   'color' => '#F7DF1E'],
            'PHP'       => ['icon' => 'bi-filetype-php',  'color' => '#8390FA'], // Wisteria
            'MySQL'     => ['icon' => 'bi-database',      'color' => '#21897E'], // Dark Cyan
            'GitHub'    => ['icon' => 'bi-github',        'color' => '#FDFFFC'], // Porcelain
            'Bootstrap' => ['icon' => 'bi-bootstrap',     'color' => '#7952B3'],
        ];
    }

    /**
     * Pomocnicza funkcja do wyświetlania ikon na stronie głównej.
     * Zamienia tekst "HTML, CSS" na kolorowe ikonki Bootstrap Icons.
     */
    public function getTechIconsHtml()
    {
        $techMap = self::getTechList();
        $techs = explode(', ', (string)$this->technologies);
        $html = '<div class="tech-icons-display">';
        
        foreach ($techs as $tech) {
            $tech = trim($tech);
            if (isset($techMap[$tech])) {
                $icon = $techMap[$tech]['icon'];
                $color = $techMap[$tech]['color'];
                // Tworzy element <i> z odpowiednią klasą i kolorem.
                $html .= Html::tag('i', '', [
                    'class' => "bi {$icon} tech-tile-icon me-2",
                    'style' => "color: {$color}; font-size: 1.5rem;",
                    'title' => $tech,
                ]);
            }
        }
        
        $html .= '</div>';
        return $html;
    }

    /**
     * Etykiety pól wyświetlane w formularzach i tabelach.
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Tytuł projektu',
            'description' => 'Opis realizacji',
            'technologies' => 'Wykorzystane technologie',
            'image_url' => 'Adres URL miniatury',
            'link' => 'Link do repozytorium/demo',
        ];
    }
}