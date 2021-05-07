<?php

use yii\db\Migration;

/**
 * Class m210504_123018_insert_admin_user
 */
class m210504_123018_insert_admin_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('user', [
            'username' => 'admin',
            'auth_key' => 'QL9lH38NdrLqoz1fcZKv28-3Xkks5pnr',
            'password_hash' => '$2y$13$Ydtb1fbC94ALP.meZr3ocO9knpME0IljmM/3Y8rTcCleoTOEQ8qhC',
            'email' => 'admin@backend.ru',
            'status' => 10,
            'created_at' => time(),
            'updated_at' => time(),
            'verification_token' => 'XPRAwoXp-FLnGe0arc4HZeoRHFVyGk7V_1620133395',
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->truncateTable('user');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210504_123018_insert_admin_user cannot be reverted.\n";

        return false;
    }
    */
}
