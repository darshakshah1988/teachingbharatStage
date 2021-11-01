<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddStartNEndToSessionBookings extends AbstractMigration
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
        $table->addColumn('start_date', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('end_date', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->changeColumn('teacher_schedule_id', 'integer', ['default' => null, 'null' => true]);
        $table->changeColumn('subject_id', 'integer', ['default' => null, 'null' => true]);
        $table->changeColumn('grading_type_id', 'integer', ['default' => null, 'null' => true]);
        $table->changeColumn('board_id', 'integer', ['default' => null, 'null' => true]);
        $table->update();
    }
}
