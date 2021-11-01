<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddSlugToCourses extends AbstractMigration
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
        $table->addColumn('slug', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
            'after' => 'listing_id'
        ]);
        $table->addIndex([
            'slug',
            ], [
            'name' => 'course_slug_inx',
            'unique' => false,
        ]);
        $table->update();
    }
}
