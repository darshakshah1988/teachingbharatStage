<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddFeaturesToCourses extends AbstractMigration
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
        $table->addColumn('features', 'text', [
            'default' => null,
            'null' => true,
            'after' => 'description'
        ]);
        $table->update();
    }
}
