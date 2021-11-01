<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddStartDateTypeToCourses extends AbstractMigration
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
        $table->changeColumn('start_date', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->changeColumn('end_date', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
         $table->changeColumn('is_free', 'boolean', [
            'default' => null,
            'null' => true,
        ]);
        $table->update();
    }
}
