<?php
declare(strict_types=1);

namespace Orders\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use Orders\Model\Table\TeacherStudentMappingsTable;

/**
 * Orders\Model\Table\TeacherStudentMappingsTable Test Case
 */
class TeacherStudentMappingsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Orders\Model\Table\TeacherStudentMappingsTable
     */
    protected $TeacherStudentMappings;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.Orders.TeacherStudentMappings',
        'plugin.Orders.Students',
        'plugin.Orders.Packages',
        'plugin.Orders.Subjects',
        'plugin.Orders.MicroSessions',
        'plugin.Orders.Teachers',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('TeacherStudentMappings') ? [] : ['className' => TeacherStudentMappingsTable::class];
        $this->TeacherStudentMappings = $this->getTableLocator()->get('TeacherStudentMappings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->TeacherStudentMappings);

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
