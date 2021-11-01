<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddUserIdToCourses extends AbstractMigration
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
        $table = $this->table('courses');
        $table->addColumn('user_id', 'uuid', [
            'default' => null,
            'null' => true,
            'after' => 'listing_id'
        ]);

        $table->addIndex([
            'user_id',
        
            ], [
            'name' => 'course_user_index',
            'unique' => false,
        ]);

        $table->addForeignKey('user_id', 'users', 'id', array('delete' => 'CASCADE', 'update' => 'CASCADE'));

        $table->update();
    }
}
