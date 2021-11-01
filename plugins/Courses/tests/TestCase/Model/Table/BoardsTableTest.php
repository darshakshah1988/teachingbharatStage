<?php
declare(strict_types=1);

namespace Courses\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use Courses\Model\Table\BoardsTable;

/**
 * Courses\Model\Table\BoardsTable Test Case
 */
class BoardsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Courses\Model\Table\BoardsTable
     */
    protected $Boards;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.Courses.Boards',
        'plugin.Courses.Listings',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Boards') ? [] : ['className' => BoardsTable::class];
        $this->Boards = $this->getTableLocator()->get('Boards', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Boards);

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
