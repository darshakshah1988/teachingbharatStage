<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddCodeNReferralToUsers extends AbstractMigration
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
        $table = $this->table('users');
        $table->addColumn('code', 'string', [
            'default' => null,
            'limit' => 50,
            'null' => true,
            'after' => 'id'
        ]);

        $table->addColumn('referred_by', 'uuid', [
            'default' => null,
            'null' => true,
            'after' => 'photo_type'
        ]);

        $table->addIndex([
            'referred_by',
        
            ], [
            'name' => 'referred_by_user_idx',
            'unique' => false,
        ]);

        $table->addIndex([
            'code',
        
            ], [
            'name' => 'USER_CODE_INDEX',
            'unique' => true,
        ]);
         $table->addForeignKey('referred_by', 'users', 'id', array('delete' => 'CASCADE', 'update' => 'CASCADE'));
        $table->update();
    }
}
