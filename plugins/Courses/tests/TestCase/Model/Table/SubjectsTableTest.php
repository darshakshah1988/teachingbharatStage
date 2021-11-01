<?php
declare(strict_types=1);

namespace Courses\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use Courses\Model\Table\SubjectsTable;

/**
 * Courses\Model\Table\SubjectsTable Test Case
 */
class SubjectsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Courses\Model\Table\SubjectsTable
     */
    protected $Subjects;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.Courses.Subjects',
        'plugin.Courses.Courses',
        'plugin.Courses.SubjectsTeachers',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Subjects') ? [] : ['className' => SubjectsTable::class];
        $this->Subjects = $this->getTableLocator()->get('Subjects', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Subjects);

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
