<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddProfilePhotoToUsers extends AbstractMigration
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
        $table = $this->table('users');
        $table->addColumn('profile_photo', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
            'after' => 'role',
        ]);

        $table->addColumn('photo_dir', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
            'after' => 'profile_photo',
        ]);
        $table->addColumn('photo_size', 'integer', [
            'default' => null,
            'limit' => 6,
            'null' => true,
            'after' => 'photo_dir',
        ]);
        $table->addColumn('photo_type', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
            'after' => 'photo_size',
        ]);
        $table->update();
    }
}
