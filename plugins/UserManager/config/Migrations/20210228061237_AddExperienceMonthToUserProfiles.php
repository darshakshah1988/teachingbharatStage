<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddExperienceMonthToUserProfiles extends AbstractMigration
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
        $table->addColumn('experience_month', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
            'after' => 'experience'
        ]);
        $table->update();
    }
}
