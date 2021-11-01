<?php
declare(strict_types=1);

namespace Orders\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use Orders\Model\Table\OrderCoursesTable;

/**
 * Orders\Model\Table\OrderCoursesTable Test Case
 */
class OrderCoursesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Orders\Model\Table\OrderCoursesTable
     */
    protected $OrderCourses;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.Orders.OrderCourses',
        'plugin.Orders.Orders',
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
        $config = $this->getTableLocator()->exists('OrderCourses') ? [] : ['className' => OrderCoursesTable::class];
        $this->OrderCourses = $this->getTableLocator()->get('OrderCourses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->OrderCourses);

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
