<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddNoOfSeatsToCourses extends AbstractMigration
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
        $table->addColumn('no_of_seats', 'integer', [
            'default' => null,
            'limit' => 11,
			'after' => 'end_date'
            'null' => false,
        ]);
        $table->update();
    }
}
