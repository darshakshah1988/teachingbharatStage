<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateListings extends AbstractMigration
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
        $table = $this->table('listings');
        $table->addColumn('admin_user_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('code', 'string', [
            'default' => null,
            'limit' => 180,
            'null' => false,
        ]);
        $table->addColumn('listing_type_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('parent_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
        ]);
        $table->addColumn('title', 'string', [
            'default' => null,
            'limit' => 250,
            'null' => false,
        ]);
        $table->addColumn('slug', 'string', [
            'default' => null,
            'limit' => 250,
            'null' => false,
        ]);
        $table->addColumn('tag_line', 'string', [
            'default' => null,
            'limit' => 250,
            'null' => true,
        ]);
        $table->addColumn('protocol', 'enum', [
            'default' => null,
            'null' => false,
            'values' => ['http://', 'https://']
        ]);
        $table->addColumn('domain_name', 'string', [
            'default' => null,
            'limit' => 100,
            'null' => true,
        ]);
        $table->addColumn('registration_no', 'string', [
            'default' => null,
            'limit' => 100,
            'null' => true,
        ]);
        $table->addColumn('registration_date', 'date', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('logo', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('logo_dir', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('logo_size', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
        ]);
        $table->addColumn('logo_type', 'string', [
            'default' => null,
            'limit' => 50,
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
        $table->addColumn('thumb_image', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('thumb_image_dir', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('thumb_image_size', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
        ]);
        $table->addColumn('thumb_image_type', 'string', [
            'default' => null,
            'limit' => 50,
            'null' => true,
        ]);
        $table->addColumn('location_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
        ]);
        $table->addColumn('address_line_1', 'string', [
            'default' => null,
            'limit' => 150,
            'null' => true,
        ]);
        $table->addColumn('address_line_2', 'string', [
            'default' => null,
            'limit' => 150,
            'null' => true,
        ]);
        $table->addColumn('postcode', 'string', [
            'default' => null,
            'limit' => 8,
            'null' => true,
        ]);
        $table->addColumn('latitude', 'string', [
            'default' => null,
            'limit' => 80,
            'null' => true,
        ]);
        $table->addColumn('longitude', 'string', [
            'default' => null,
            'limit' => 80,
            'null' => true,
        ]);
        $table->addColumn('short_description', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('description', 'text', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('meta_title', 'string', [
            'default' => null,
            'limit' => 200,
            'null' => true,
        ]);
        $table->addColumn('meta_keyword', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('meta_description', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('is_visible', 'boolean', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('status', 'boolean', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('sort_order', 'integer', [
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
            'code',
        
            ], [
            'name' => 'CODE_INDEX',
            'unique' => true,
        ]);
        $table->addIndex([
            'slug',
        
            ], [
            'name' => 'SLUG_INDEX',
            'unique' => true,
        ]);
        $table->create();
    }
}
