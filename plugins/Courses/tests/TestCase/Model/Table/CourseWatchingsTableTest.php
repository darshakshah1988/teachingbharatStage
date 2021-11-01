<?php
declare(strict_types=1);

namespace Courses\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use Courses\Model\Table\CourseWatchingsTable;

/**
 * Courses\Model\Table\CourseWatchingsTable Test Case
 */
class CourseWatchingsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Courses\Model\Table\CourseWatchingsTable
     */
    protected $CourseWatchings;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.Courses.CourseWatchings',
        'plugin.Courses.Courses',
        'plugin.Courses.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('CourseWatchings') ? [] : ['className' => CourseWatchingsTable::class];
        $this->CourseWatchings = $this->getTableLocator()->get('CourseWatchings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->CourseWatchings);

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
