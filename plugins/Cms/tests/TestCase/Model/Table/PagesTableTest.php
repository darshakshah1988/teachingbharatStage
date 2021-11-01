<?php
declare(strict_types=1);

namespace Cms\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Cms\Model\Table\PagesTable;

/**
 * Cms\Model\Table\PagesTable Test Case
 */
class PagesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Cms\Model\Table\PagesTable
     */
    protected $Pages;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.Cms.Pages',
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
        $config = TableRegistry::getTableLocator()->exists('Pages') ? [] : ['className' => PagesTable::class];
        $this->Pages = TableRegistry::getTableLocator()->get('Pages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Pages);

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
