<?php
declare(strict_types=1);

namespace Orders\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use Orders\Model\Table\CartsTable;

/**
 * Orders\Model\Table\CartsTable Test Case
 */
class CartsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Orders\Model\Table\CartsTable
     */
    protected $Carts;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.Orders.Carts',
        'plugin.Orders.Users',
        'plugin.Orders.Courses',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Carts') ? [] : ['className' => CartsTable::class];
        $this->Carts = $this->getTableLocator()->get('Carts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Carts);

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
