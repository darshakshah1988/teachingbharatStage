<?php
declare(strict_types=1);

namespace Courses\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use Courses\Model\Table\CourseChaptersTable;

/**
 * Courses\Model\Table\CourseChaptersTable Test Case
 */
class CourseChaptersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Courses\Model\Table\CourseChaptersTable
     */
    protected $CourseChapters;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.Courses.CourseChapters',
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
        $config = $this->getTableLocator()->exists('CourseChapters') ? [] : ['className' => CourseChaptersTable::class];
        $this->CourseChapters = $this->getTableLocator()->get('CourseChapters', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->CourseChapters);

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
