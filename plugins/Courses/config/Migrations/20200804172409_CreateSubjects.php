<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateSubjects extends AbstractMigration
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
        $table = $this->table('subjects');
        $table->addColumn('course_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
        ]);
        $table->addColumn('title', 'string', [
            'default' => null,
            'limit' => 200,
            'null' => false,
        ]);
        $table->addColumn('max_weekly_classes', 'integer', [
            'default' => null,
            'limit' => 5,
            'null' => true,
        ]);
        $table->addColumn('credit_hours', 'integer', [
            'default' => null,
            'limit' => 5,
            'null' => true,
        ]);
        $table->addColumn('is_activity', 'boolean', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('is_exam', 'boolean', [
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
            'course_id',
        ], [
            'name' => 'BY_Cour_SUBJECT_ID',
            'unique' => false,
        ]);
        $table->create();
    }
}
