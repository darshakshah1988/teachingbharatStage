<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateAdminUsersRoles extends AbstractMigration
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
        $table = $this->table('admin_users_roles');
        $table->addColumn('role_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('admin_user_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addIndex([
            'role_id',
        
            ], [
            'name' => 'BY_ROLE_ID',
            'unique' => false,
        ]);
        $table->addIndex([
            'admin_user_id',
        
            ], [
            'name' => 'BY_ADMIN_USER_ID',
            'unique' => false,
        ]);
        $table->create();
    }
}
