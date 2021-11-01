<?php
declare(strict_types=1);

namespace Orders\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use Orders\Model\Table\OrderCouponsTable;

/**
 * Orders\Model\Table\OrderCouponsTable Test Case
 */
class OrderCouponsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Orders\Model\Table\OrderCouponsTable
     */
    protected $OrderCoupons;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.Orders.OrderCoupons',
        'plugin.Orders.Orders',
        'plugin.Orders.Coupons',
        'plugin.Orders.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('OrderCoupons') ? [] : ['className' => OrderCouponsTable::class];
        $this->OrderCoupons = $this->getTableLocator()->get('OrderCoupons', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->OrderCoupons);

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
