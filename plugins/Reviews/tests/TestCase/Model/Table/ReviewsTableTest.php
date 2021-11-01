<?php
declare(strict_types=1);

namespace Reviews\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use Reviews\Model\Table\ReviewsTable;

/**
 * Reviews\Model\Table\ReviewsTable Test Case
 */
class ReviewsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Reviews\Model\Table\ReviewsTable
     */
    protected $Reviews;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.Reviews.Reviews',
        'plugin.Reviews.Users',
        'plugin.Reviews.Courses',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Reviews') ? [] : ['className' => ReviewsTable::class];
        $this->Reviews = $this->getTableLocator()->get('Reviews', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Reviews);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
