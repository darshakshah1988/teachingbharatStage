<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddMobileVerifyNOptToUserProfiles extends AbstractMigration
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
        $table->addColumn('is_mobile_verified', 'boolean', [
            'default' => null,
            'null' => true,
            'after' => 'mobile',
        ]);
        $table->addColumn('sms_otp', 'string', [
            'default' => null,
            'limit' => 20,
            'null' => true,
            'after' => 'is_mobile_verified',
        ]);
        $table->update();
    }
}
 