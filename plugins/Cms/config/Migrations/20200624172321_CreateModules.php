<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateModules extends AbstractMigration
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
        $table = $this->table('modules');
        $table->addColumn('listing_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('title', 'string', [
            'default' => null,
            'limit' => 150,
            'null' => false,
        ]);
        $table->addColumn('plugin', 'string', [
            'default' => null,
            'limit' => 120,
            'null' => true,
        ]);
        $table->addColumn('controller', 'string', [
            'default' => null,
            'limit' => 120,
            'null' => false,
        ]);
        $table->addColumn('action', 'string', [
            'default' => null,
            'limit' => 100,
            'null' => false,
        ]);
        $table->addColumn('json_path', 'string', [
            'default' => null,
            'limit' => 700,
            'null' => true,
        ]);
        $table->addColumn('query_string', 'string', [
            'default' => null,
            'limit' => 250,
            'null' => true,
        ]);
        $table->addColumn('banner', 'string', [
            'default' => null,
            'limit' => 255,
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
        $table->addColumn('meta_title', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('meta_keyword', 'string', [
            'default' => null,
            'limit' => 300,
            'null' => false,
        ]);
        $table->addColumn('meta_description', 'text', [
            'default' => null,
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
        $table->addIndex([
            'plugin',
        
            ], [
            'name' => null,
            'unique' => false,
        ]);

        $table->addForeignKey('listing_id', 'listings', ['id'],
                            ['constraint' => 'modules_listing_frk_key']);


        $table->create();
    }
}
