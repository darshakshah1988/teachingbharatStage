<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddRateToUserProfiles extends AbstractMigration
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
        $table->addColumn('rate', 'decimal', [
            'default' => null,
            'null' => true,
            'precision' => 8,
            'scale' => 2,
            'after' => 'experience',
        ]);
        $table->update();
    }
}
