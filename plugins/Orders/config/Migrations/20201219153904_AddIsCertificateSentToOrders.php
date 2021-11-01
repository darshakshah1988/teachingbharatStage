<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddIsCertificateSentToOrders extends AbstractMigration
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
        $table->addColumn('is_certificate_sent', 'smallinteger', [
            'default' => null,
            'limit' => 6,
            'null' => true,
        ]);
        $table->update();
    }
}
