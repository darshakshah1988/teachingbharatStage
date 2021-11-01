<?php
declare(strict_types=1);

namespace MicroSessions\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use MicroSessions\Model\Table\PlansTable;

/**
 * MicroSessions\Model\Table\PlansTable Test Case
 */
class PlansTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \MicroSessions\Model\Table\PlansTable
     */
    protected $Plans;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.MicroSessions.Plans',
        'plugin.MicroSessions.Listings',
        'plugin.MicroSessions.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Plans') ? [] : ['className' => PlansTable::class];
        $this->Plans = $this->getTableLocator()->get('Plans', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Plans);

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
