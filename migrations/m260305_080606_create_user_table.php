<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m260305_080606_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->createTable('trening', [
          'id' => $this->primaryKey(),
          'start_date' => $this->dateTime(),
          'end_date' => $this->dateTime(),
          'type' => $this->string(30)
      ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->dropTable('trening');
    }
}
