<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddNewColumnToUserProfiles extends AbstractMigration
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
        $table->addColumn('achievement', 'string', [
            'default' => null,
            'limit' => 250,
            'null' => true,
        ]);
        $table->addColumn('other_achievement', 'string', [
            'default' => null,
            'limit' => 250,
            'null' => true,
        ]);
        $table->addColumn('digital_experience', 'string', [
            'default' => null,
            'limit' => 250,
            'null' => true,
        ]);
        $table->update();
    }
}
