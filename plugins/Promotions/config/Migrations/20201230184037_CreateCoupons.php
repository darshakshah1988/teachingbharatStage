<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateCoupons extends AbstractMigration
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
        $table = $this->table('coupons');
        $table->addColumn('name', 'string', [
            'default' => null,
            'limit' => 250,
            'null' => false,
        ]);
        $table->addColumn('code', 'string', [
            'default' => null,
            'limit' => 250,
            'null' => false,
        ]);
        $table->addColumn('coupon_type', 'string', [
            'default' => null,
            'limit' => 25,
            'null' => false,
        ]);
        $table->addColumn('discount', 'decimal', [
            'default' => null,
            'null' => false,
            'precision' => 8,
            'scale' => 2,
        ]);
        $table->addColumn('total', 'decimal', [
            'default' => null,
            'null' => true,
            'precision' => 8,
            'scale' => 2,
        ]);
        $table->addColumn('date_start', 'date', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('date_end', 'date', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('uses_total', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('uses_customer', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('status', 'boolean', [
            'default' => null,
            'null' => false,
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
