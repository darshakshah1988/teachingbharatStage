<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddPasswordToUserProfiles extends AbstractMigration
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
        $table->addColumn('password', 'text', [
            'default' => null,
            'null' => true,
			'after' => 'digital_experience'
        ]);
        $table->update();
    }
}
