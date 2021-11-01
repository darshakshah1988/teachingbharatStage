<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddTopicStatusToSessionBookings extends AbstractMigration
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
        $table->addColumn('topic', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
            'after'=> 'booking_date'
        ]);
        $table->addColumn('comment', 'text', [
            'default' => null,
            'null' => true,
            'after'=> 'topic'
        ]);
        $table->addColumn('session_status', 'integer', [
            'default' => null,
            'limit' => 6,
            'null' => true,
            'after'=> 'comment'
        ]);
        $table->update();
    }
}
