<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddReviewTypeToReviews extends AbstractMigration
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
        $table = $this->table('reviews');
        $table->addColumn('review_type', 'string', [
            'default' => null,
            'limit' => 100,
            'null' => true,
        ]);

        $table->update();
        $table = $this->table('reviews');
        $table->changeColumn('course_id', 'integer', ['null' => true])->save();
    }
}
