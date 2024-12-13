<?php

use yii\db\Migration;

/**
 * Class m241213_061043_AddField
 */
class m241213_061043_AddField extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%link}}', 'counter', 'int default 0');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m241213_061043_AddField cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241213_061043_AddField cannot be reverted.\n";

        return false;
    }
    */
}
