<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%bonus}}`.
 */
class m210506_082858_create_bonus_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%bonus}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'b_count' => $this->integer()->notNull(), 
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%bonus}}');
    }
}
