<?php
declare(strict_types=1);

namespace Events\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Events\Model\Table\EventDocumentsTable;

/**
 * Events\Model\Table\EventDocumentsTable Test Case
 */
class EventDocumentsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Events\Model\Table\EventDocumentsTable
     */
    protected $EventDocuments;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.Events.EventDocuments',
        'plugin.Events.Events',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('EventDocuments') ? [] : ['className' => EventDocumentsTable::class];
        $this->EventDocuments = TableRegistry::getTableLocator()->get('EventDocuments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->EventDocuments);

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
