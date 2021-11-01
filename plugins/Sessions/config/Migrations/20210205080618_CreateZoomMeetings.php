<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateZoomMeetings extends AbstractMigration
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
        $table = $this->table('zoom_meetings');
        $table->addColumn('user_id', 'uuid', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('uuid', 'string', [
            'default' => null,
            'limit' => 100,
            'null' => true,
        ]);
        $table->addColumn('meeting_id', 'biginteger', [
            'default' => null,
            'limit' => 50,
            'null' => true,
        ]);
        $table->addColumn('host_id', 'string', [
            'default' => null,
            'limit' => 100,
            'null' => true,
        ]);
        $table->addColumn('host_email', 'string', [
            'default' => null,
            'limit' => 200,
            'null' => true,
        ]);
        $table->addColumn('topic', 'text', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('type', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('status', 'string', [
            'default' => null,
            'limit' => 20,
            'null' => true,
        ]);
        $table->addColumn('start_time', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('duration', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('timezone', 'string', [
            'default' => null,
            'limit' => 100,
            'null' => true,
        ]);
        $table->addColumn('created_at', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('start_url', 'string', [
            'default' => null,
            'limit' => 300,
            'null' => true,
        ]);
        $table->addColumn('join_url', 'string', [
            'default' => null,
            'limit' => 300,
            'null' => true,
        ]);
        $table->addColumn('password', 'string', [
            'default' => null,
            'limit' => 20,
            'null' => true,
        ]);
        $table->addColumn('h323_password', 'string', [
            'default' => null,
            'limit' => 20,
            'null' => true,
        ]);
        $table->addColumn('pstn_password', 'string', [
            'default' => null,
            'limit' => 20,
            'null' => true,
        ]);
        $table->addColumn('encrypted_password', 'string', [
            'default' => null,
            'limit' => 200,
            'null' => true,
        ]);
        $table->addColumn('settings', 'text', [
            'default' => null,
            'null' => false,
        ]);
        $table->create();
    }
}
