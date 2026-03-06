<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * Model dla tabeli "message"
 */
class Message extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%message}}';
    }

    public function rules()
    {
        return [
            [['name', 'email', 'body'], 'required'],
            [['body'], 'string'],
            [['email'], 'email'],
            [['name', 'email'], 'string', 'max' => 255],
            [['created_at'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Imię i nazwisko',
            'email' => 'E-mail',
            'body' => 'Treść wiadomości',
            'created_at' => 'Data wysłania',
        ];
    }
}