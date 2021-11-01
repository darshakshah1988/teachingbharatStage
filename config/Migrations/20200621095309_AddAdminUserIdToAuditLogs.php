<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddAdminUserIdToAuditLogs extends AbstractMigration
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
        $table = $this->table('audit_logs');
        $table->addColumn('admin_user_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
            'after' => 'id'
        ]);
        $table->update();
    }
}
