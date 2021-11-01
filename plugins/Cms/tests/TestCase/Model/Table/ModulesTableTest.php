<?php
declare(strict_types=1);

namespace Cms\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Cms\Model\Table\ModulesTable;

/**
 * Cms\Model\Table\ModulesTable Test Case
 */
class ModulesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Cms\Model\Table\ModulesTable
     */
    protected $Modules;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.Cms.Modules',
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
        $config = TableRegistry::getTableLocator()->exists('Modules') ? [] : ['className' => ModulesTable::class];
        $this->Modules = TableRegistry::getTableLocator()->get('Modules', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Modules);

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
