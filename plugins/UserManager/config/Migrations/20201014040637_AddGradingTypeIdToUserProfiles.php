<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddGradingTypeIdToUserProfiles extends AbstractMigration
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
        $table->addColumn('grading_type_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
            'after' => 'gender',
        ]);
        $table->update();
    }
}
