<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateEventDocuments extends AbstractMigration
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
        $table = $this->table('event_documents');
        $table->addColumn('event_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('file_type', 'smallinteger', [
            'default' => null,
            'limit' => 6,
            'null' => false,
        ]);
        $table->addColumn('title', 'string', [
            'default' => null,
            'limit' => 150,
            'null' => true,
        ]);
        $table->addColumn('caption', 'string', [
            'default' => null,
            'limit' => 400,
            'null' => true,
        ]);
        $table->addColumn('banner', 'string', [
            'default' => null,
            'limit' => 250,
            'null' => true,
        ]);
        $table->addColumn('banner_dir', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('banner_size', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
        ]);
        $table->addColumn('banner_type', 'string', [
            'default' => null,
            'limit' => 50,
            'null' => true,
        ]);
        
        $table->addColumn('position', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->create();
    }
}
