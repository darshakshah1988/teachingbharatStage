<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddTeacherIdToSessionBookings extends AbstractMigration
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
        $table = $this->table('session_bookings');
        $table->addColumn('teacher_id', 'uuid', [
            'default' => null,
            'null' => false,
            'after' => 'user_id'
        ]);
        $table->update();
    }
}
