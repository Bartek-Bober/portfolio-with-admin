<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%message}}`.
 */
class m260305_110538_create_message_table extends Migration
{
  public function safeUp()
    {
        $this->createTable('{{%message}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
            'body' => $this->text()->notNull(),
            'created_at' => $this->integer()->notNull(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%message}}');
    }
}
