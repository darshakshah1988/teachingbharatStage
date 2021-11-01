<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateOrders extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('orders');
        $table->addColumn('invoice_no', 'string', [
            'default' => null,
            'limit' => 150,
            'null' => true,
        ]);
        $table->addColumn('user_id', 'uuid', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('amount', 'decimal', [
            'default' => null,
            'null' => true,
            'precision' => 8,
            'scale' => 2,
        ]);
        $table->addColumn('discount', 'decimal', [
            'default' => null,
            'null' => true,
            'precision' => 8,
            'scale' => 2,
        ]);
        $table->addColumn('total_amount', 'decimal', [
            'default' => null,
            'null' => true,
            'precision' => 8,
            'scale' => 2,
        ]);
        $table->addColumn('order_date', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('razorpay_order', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('note', 'text', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('invoice_file', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->create();
    }
}
