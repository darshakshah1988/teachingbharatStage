<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateUsersGradingTypes extends AbstractMigration
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
        $table = $this->table('users_grading_types');
        $table->addColumn('user_id', 'uuid', [
            'default' => null,
            'null' => false, 
        ]);
        $table->addColumn('grading_type_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);

        $table->addForeignKey('user_id', 'users', 'id', array('delete' => 'CASCADE', 'update' => 'CASCADE'));
        $table->addForeignKey('grading_type_id', 'grading_types', 'id', array('delete' => 'CASCADE', 'update' => 'CASCADE'));
        $table->create();
    }
}
