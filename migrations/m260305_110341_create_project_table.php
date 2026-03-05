<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%project}}`.
 */
class m260305_110341_create_project_table extends Migration
{
    /**
     * {@inheritdoc}
     */
   public function safeUp()
    {
        $this->createTable('{{%project}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'description' => $this->text(),
            'technologies' => $this->string(),
            'image_url' => $this->string(),
            'link' => $this->string(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%project}}');
    }
}
