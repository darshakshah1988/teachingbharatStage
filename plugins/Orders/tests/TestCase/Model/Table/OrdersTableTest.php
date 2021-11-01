<?php
declare(strict_types=1);

namespace Orders\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use Orders\Model\Table\OrdersTable;

/**
 * Orders\Model\Table\OrdersTable Test Case
 */
class OrdersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Orders\Model\Table\OrdersTable
     */
    protected $Orders;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.Orders.Orders',
        'plugin.Orders.Users',
        'plugin.Orders.OrderCourses',
        'plugin.Orders.Phinxlog',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Orders') ? [] : ['className' => OrdersTable::class];
        $this->Orders = $this->getTableLocator()->get('Orders', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Orders);

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
