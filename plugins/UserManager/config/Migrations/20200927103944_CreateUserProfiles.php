<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateUserProfiles extends AbstractMigration
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
        $table = $this->table('user_profiles');
        $table->addColumn('user_id', 'uuid', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('mobile', 'string', [
            'default' => null,
            'limit' => 20,
            'null' => true,
        ]);
        $table->addColumn('alt_mobile', 'string', [
            'default' => null,
            'limit' => 20,
            'null' => true,
        ]);
        $table->addColumn('dob', 'date', [
            'default' => null,
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
        $table->addColumn('pin_number', 'string', [
            'default' => null,
            'limit' => 80,
            'null' => true,
        ]);
        $table->addColumn('gender', 'string', [
            'default' => null,
            'limit' => 10,
            'null' => true,
        ]);
        $table->addColumn('qualification', 'string', [
            'default' => null,
            'limit' => 250,
            'null' => true,
        ]);
        $table->addColumn('college_university', 'string', [
            'default' => null,
            'limit' => 250,
            'null' => true,
        ]);
        $table->addColumn('occupation_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
        ]);
        $table->addColumn('experience', 'string', [
            'default' => null,
            'limit' => 50,
            'null' => true,
        ]);
        $table->addColumn('primary_subject_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
        ]);
        $table->addColumn('secondary_subject_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
        ]);
        $table->addColumn('hours_inweekdays', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('hours_inweekend', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('is_digital_pen_tablet', 'boolean', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('is_internet_speed_mbps', 'boolean', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('source_of_rudraa', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('resume', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('resume_dir', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('resume_size', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
        ]);
        $table->addColumn('resume_type', 'string', [
            'default' => null,
            'limit' => 80,
            'null' => true,
        ]);

        $table->addColumn('about_me', 'text', [
            'default' => null,
            'null' => true,
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
            'user_id',
        
            ], [
            'name' => 'user_profile_indx',
            'unique' => false,
        ]);

        $table->addForeignKey('user_id', 'users', 'id', array('delete' => 'CASCADE', 'update' => 'CASCADE'));
        
        $table->create();
    }
}
