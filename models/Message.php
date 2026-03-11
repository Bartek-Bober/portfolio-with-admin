<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * Model dla tabeli "message".
 */
class Message extends ActiveRecord
{
    public static function tableName()
    {
        return 'message';
    }

    /**
     * Automatycznie uzupełnia kolumnę created_at aktualnym czasem (Unix Timestamp)
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => false, // Nie mamy kolumny updated_at
            ],
        ];
    }

    public function rules()
    {
        return [
            [['name', 'email', 'subject', 'body'], 'required', 'message' => 'To pole nie może być puste.'],
            ['email', 'email', 'message' => 'Podaj poprawny adres e-mail.'],
            [['body'], 'string'],
            [['is_read'], 'integer'],
            [['created_at'], 'integer'],
            [['name', 'email', 'subject'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nadawca',
            'email' => 'Adres E-mail',
            'subject' => 'Temat',
            'body' => 'Treść wiadomości',
            'is_read' => 'Przeczytana',
            'created_at' => 'Data nadania',
        ];
    }
}