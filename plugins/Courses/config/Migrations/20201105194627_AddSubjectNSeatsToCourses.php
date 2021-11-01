<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddSubjectNSeatsToCourses extends AbstractMigration
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

        $table->changeColumn('section_name', 'string', ['default' => null,'limit' => 250, 'null' => true]);

        $table->changeColumn('start_date', 'date', ['default' => null, 'null' => true]);

        $table->changeColumn('end_date', 'date', ['default' => null, 'null' => true]);

        $table->removeColumn('position');

        $table->addColumn('board_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
            'after' => 'code'
        ]);
        $table->addColumn('subject_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
            'after' => 'board_id'
        ]);
        $table->addColumn('duration', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
            'after' => 'subject_id'
        ]);
        $table->addColumn('price', 'decimal', [
            'default' => null,
            'null' => true,
            'precision' => 8,
            'scale' => 2,
            'after' => 'duration'
        ]);
        $table->addColumn('discount_price', 'decimal', [
            'default' => null,
            'null' => true,
            'precision' => 8,
            'scale' => 2,
            'after' => 'price'
        ]);
        $table->addColumn('is_free', 'boolean', [
            'default' => null,
            'null' => false,
            'after' => 'discount_price'
        ]);
        $table->addColumn('sample_video', 'string', [
            'default' => null,
            'limit' => 250,
            'null' => true,
            'after' => 'is_free'
        ]);
        $table->addColumn('short_description', 'string', [
            'default' => null,
            'limit' => 400,
            'null' => true,
            'after' => 'sample_video'
        ]);
        $table->addColumn('description', 'text', [
            'default' => null,
            'null' => true,
            'after' => 'short_description'
        ]);
         $table->addColumn('is_draft', 'boolean', [
            'default' => 0,
            'null' => false,
            'after' => 'description'
        ]);
        $table->addIndex([
            'board_id',
            ], [
            'name' => 'BY_COURSE_BOARD_ID',
            'unique' => false,
        ]);
        $table->addIndex([
            'subject_id',
            ], [
            'name' => 'BY_COURSE_SUBJECT_ID',
            'unique' => false,
        ]);
        $table->addForeignKey('board_id', 'boards', ['id'],
                            ['constraint' => 'course_boards']);
        $table->addForeignKey('subject_id', 'subjects', ['id'],
                            ['constraint' => 'course_subjects']);
        $table->update();

    }
}
//ALTER TABLE `courses` ADD `is_draft` TINYINT NOT NULL DEFAULT '0' AFTER `description`; 