<?php
declare(strict_types=1);

namespace Events\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Events\Model\Table\EventsTable;

/**
 * Events\Model\Table\EventsTable Test Case
 */
class EventsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Events\Model\Table\EventsTable
     */
    protected $Events;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.Events.Events',
        'plugin.Events.AdminUsers',
        'plugin.Events.Listings',
        'plugin.Events.EventDocuments',
        'plugin.Events.EventSocialLinks',
        'plugin.Events.Phinxlog',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Events') ? [] : ['className' => EventsTable::class];
        $this->Events = TableRegistry::getTableLocator()->get('Events', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Events);

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
