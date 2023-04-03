<?php

use yii\db\Migration;

/**
 * Class m230403_183934_add_schema
 */
class m230403_183934_add_schema extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute(file_get_contents('./web/schema.sql', true));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230403_183934_add_schema cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230403_183934_add_schema cannot be reverted.\n";

        return false;
    }
    */
}
