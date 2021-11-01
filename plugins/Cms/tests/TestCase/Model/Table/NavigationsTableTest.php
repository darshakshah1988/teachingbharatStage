<?php
declare(strict_types=1);

namespace Cms\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Cms\Model\Table\NavigationsTable;

/**
 * Cms\Model\Table\NavigationsTable Test Case
 */
class NavigationsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Cms\Model\Table\NavigationsTable
     */
    protected $Navigations;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.Cms.Navigations',
        'plugin.Cms.Listings',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Navigations') ? [] : ['className' => NavigationsTable::class];
        $this->Navigations = TableRegistry::getTableLocator()->get('Navigations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Navigations);

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
