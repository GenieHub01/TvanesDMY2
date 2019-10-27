<?php

use yii\db\Migration;

/**
 * Class m191027_184421_add_order_fields
 */
class m191027_184421_add_order_fields extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('order','worldpay_order_id', $this->string());
        $this->addColumn('order','worldpay_order_status', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropColumn('order','worldpay_order_id');
        $this->dropColumn('order','worldpay_order_status');
        echo "m191027_184421_add_order_fields was be reverted.\n";

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191027_184421_add_order_fields cannot be reverted.\n";

        return false;
    }
    */
}
