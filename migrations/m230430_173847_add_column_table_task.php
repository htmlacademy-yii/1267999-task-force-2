<?php

use yii\db\Migration;
/**
 * Class m230430_173847_add_column_table_task
 */
class m230430_173847_add_column_table_task extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('tasks', 'user_id', 'customer_id');
        $this->addColumn('tasks', 'executor_id', 'integer');
        $this->addForeignKey('fk_tasks_executor1', 'tasks', 'executor_id', 'users', 'id', 'NO ACTION', 'NO ACTION');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230430_173847_add_column_table_task cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230430_173847_add_column_table_task cannot be reverted.\n";

        return false;
    }
    */
}
