<?php

use yii\db\Migration;

/**
 * Class m241212_065348_InitTable
 */
class m241212_065348_InitTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%link}}', [
            'id' => $this->primaryKey()->unsigned(),
            'link' => $this->string(200)->notNull(),
            'short_link' => $this->string(100)->notNull(),
            'ip' => $this->string(100)->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP()'),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m241212_065348_InitTable cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241212_065348_InitTable cannot be reverted.\n";

        return false;
    }
    */
}
