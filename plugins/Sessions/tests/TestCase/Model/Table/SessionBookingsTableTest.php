<?php
declare(strict_types=1);

namespace Sessions\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use Sessions\Model\Table\SessionBookingsTable;

/**
 * Sessions\Model\Table\SessionBookingsTable Test Case
 */
class SessionBookingsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Sessions\Model\Table\SessionBookingsTable
     */
    protected $SessionBookings;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.Sessions.SessionBookings',
        'plugin.Sessions.Users',
        'plugin.Sessions.Subjects',
        'plugin.Sessions.GradingTypes',
        'plugin.Sessions.Boards',
        'plugin.Sessions.TeacherSchedules',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('SessionBookings') ? [] : ['className' => SessionBookingsTable::class];
        $this->SessionBookings = $this->getTableLocator()->get('SessionBookings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->SessionBookings);

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
