<?php
declare(strict_types=1);

namespace Courses\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use Courses\Model\Table\OrderCoursesTable;

/**
 * Courses\Model\Table\OrderCoursesTable Test Case
 */
class OrderCoursesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Courses\Model\Table\OrderCoursesTable
     */
    protected $OrderCourses;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.Courses.OrderCourses',
        'plugin.Courses.Orders',
        'plugin.Courses.Courses',
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
