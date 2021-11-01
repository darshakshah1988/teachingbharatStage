<?php
declare(strict_types=1);

namespace MicroSessions\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use MicroSessions\Model\Table\PackagesTable;

/**
 * MicroSessions\Model\Table\PackagesTable Test Case
 */
class PackagesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \MicroSessions\Model\Table\PackagesTable
     */
    protected $Packages;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.MicroSessions.Packages',
        'plugin.MicroSessions.Listings',
        'plugin.MicroSessions.Users',
        'plugin.MicroSessions.GradingTypes',
        'plugin.MicroSessions.Boards',
        'plugin.MicroSessions.Subjects',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Packages') ? [] : ['className' => PackagesTable::class];
        $this->Packages = $this->getTableLocator()->get('Packages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Packages);

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
