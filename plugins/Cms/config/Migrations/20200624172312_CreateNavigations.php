<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateNavigations extends AbstractMigration
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
        $table = $this->table('navigations');
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
        $table->addColumn('slug', 'string', [
            'default' => null,
            'limit' => 250,
            'null' => false,
        ]);
        $table->addColumn('parent_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
        ]);
        $table->addColumn('menu_link', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('is_nav_type', 'integer', [
            'default' => null,
            'limit' => 2,
            'null' => false,
        ]);

        $table->addColumn('target', 'enum', [
            'default' => null,
            'null' => false,
            'values' => ['_self', '_blank']
        ]);

        $table->addColumn('lft', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('rght', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('status', 'boolean', [ 
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('is_top', 'boolean', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('is_bottom', 'boolean', [
            'default' => null,
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
        $table->addIndex([
            'slug', 'listing_id'
        
            ], [
            'name' => 'UNIQUE_SLUG',
            'unique' => true,
        ]);
        $table->addIndex([
            'parent_id',
        
            ], [
            'name' => 'BY_PARENT_ID',
            'unique' => false,
        ]);

        $table->addForeignKey('listing_id', 'listings', ['id'],
                            ['constraint' => 'navigations_listing_frk_key']);

        $table->create();
    }
}
