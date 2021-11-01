<?php
declare(strict_types=1);

namespace Services\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Services\Model\Table\ServicesTable;

/**
 * Services\Model\Table\ServicesTable Test Case
 */
class ServicesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Services\Model\Table\ServicesTable
     */
    protected $Services;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.Services.Services',
        'plugin.Services.Listings',
        'plugin.Services.Phinxlog',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Services') ? [] : ['className' => ServicesTable::class];
        $this->Services = TableRegistry::getTableLocator()->get('Services', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Services);

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
