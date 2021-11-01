<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateSubjectsTeachers extends AbstractMigration
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
        $table = $this->table('subjects_teachers');
        $table->addColumn('subject_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('teacher_id', 'integer', [
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
            'subject_id',
        ], [
            'name' => 'BY_SUBJECT_TEC_ID',
            'unique' => false,
        ]);
        $table->addIndex([
            'teacher_id',
        ], [
            'name' => 'BY_TEC_SUBJECT_ID',
            'unique' => false,
        ]);
        $table->create();
    }
}
