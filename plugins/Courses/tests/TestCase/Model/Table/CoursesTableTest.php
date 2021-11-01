<?php
declare(strict_types=1);

namespace Courses\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Courses\Model\Table\CoursesTable;

/**
 * Courses\Model\Table\CoursesTable Test Case
 */
class CoursesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Courses\Model\Table\CoursesTable
     */
    protected $Courses;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.Courses.Courses',
        'plugin.Courses.Listings',
        'plugin.Courses.GradingTypes',
        'plugin.Courses.Subjects',
        'plugin.Courses.Phinxlog',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Courses') ? [] : ['className' => CoursesTable::class];
        $this->Courses = TableRegistry::getTableLocator()->get('Courses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Courses);

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
