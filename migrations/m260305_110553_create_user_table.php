<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m260305_110553_create_user_table extends Migration
{
   public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'password_hash' => $this->string()->notNull(),
            'auth_key' => $this->string(32)->notNull(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
