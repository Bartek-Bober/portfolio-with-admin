<?php

namespace app\models\generated;

use Yii;

/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property string|null $technologies
 * @property string|null $image_url
 * @property string|null $link
 */
class Project extends \app\models\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'technologies', 'image_url', 'link'], 'default', 'value' => null],
            [['title'], 'required'],
            [['description'], 'string'],
            [['title', 'technologies', 'image_url', 'link'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'technologies' => 'Technologies',
            'image_url' => 'Image Url',
            'link' => 'Link',
        ];
    }

}
