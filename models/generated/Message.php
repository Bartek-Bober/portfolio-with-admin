<?php

namespace app\models\generated;

use Yii;

/**
 * This is the model class for table "message".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $body
 * @property int $created_at
 */
class Message extends \app\models\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'body', 'created_at'], 'required'],
            [['body'], 'string'],
            [['created_at'], 'integer'],
            [['name', 'email'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'body' => 'Body',
            'created_at' => 'Created At',
        ];
    }

}
