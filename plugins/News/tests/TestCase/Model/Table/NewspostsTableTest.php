<?php
declare(strict_types=1);

namespace News\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use News\Model\Table\NewspostsTable;

/**
 * News\Model\Table\NewspostsTable Test Case
 */
class NewspostsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \News\Model\Table\NewspostsTable
     */
    protected $Newsposts;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.News.Newsposts',
        'plugin.News.Listings',
        'plugin.News.AdminUsers',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Newsposts') ? [] : ['className' => NewspostsTable::class];
        $this->Newsposts = TableRegistry::getTableLocator()->get('Newsposts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Newsposts);

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
