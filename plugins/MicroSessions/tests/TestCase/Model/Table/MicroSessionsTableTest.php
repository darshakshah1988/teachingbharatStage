<?php
declare(strict_types=1);

namespace MicroSessions\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use MicroSessions\Model\Table\MicroSessionsTable;

/**
 * MicroSessions\Model\Table\MicroSessionsTable Test Case
 */
class MicroSessionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \MicroSessions\Model\Table\MicroSessionsTable
     */
    protected $MicroSessions;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.MicroSessions.MicroSessions',
        'plugin.MicroSessions.Listings',
        'plugin.MicroSessions.Users',
        'plugin.MicroSessions.GradingTypes',
        'plugin.MicroSessions.AcademicYears',
        'plugin.MicroSessions.Boards',
        'plugin.MicroSessions.Subjects',
        'plugin.MicroSessions.Phinxlog',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('MicroSessions') ? [] : ['className' => MicroSessionsTable::class];
        $this->MicroSessions = $this->getTableLocator()->get('MicroSessions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->MicroSessions);

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
