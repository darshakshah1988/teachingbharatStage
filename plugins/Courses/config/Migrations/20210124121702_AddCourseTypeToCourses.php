<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddCourseTypeToCourses extends AbstractMigration
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
        $table->addColumn('course_type', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
            'after' => 'title'
        ]);
        $table->update();
    }
}
