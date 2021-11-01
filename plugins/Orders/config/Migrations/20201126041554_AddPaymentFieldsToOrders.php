<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddPaymentFieldsToOrders extends AbstractMigration
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
        $table->addColumn('payment_method', 'string', [
            'default' => null,
            'limit' => 50,
            'null' => true,
            'after' => 'invoice_file'
        ]);
        $table->addColumn('transaction_status', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
            'after' => 'payment_method'
        ]);
        $table->addColumn('transactionId', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
            'after' => 'transaction_status'
        ]);
        $table->addColumn('signature', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
            'after' => 'transactionId'
        ]);
        $table->addColumn('transaction_responce', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
            'after' => 'signature'
        ]);
        $table->update();
    }
}
