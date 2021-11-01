<?php
declare(strict_types=1);

namespace Admin\Test\TestCase\Model\Table;

use Admin\Model\Table\SubjectsTable;
use Cake\TestSuite\TestCase;

/**
 * Admin\Model\Table\SubjectsTable Test Case
 */
class SubjectsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Admin\Model\Table\SubjectsTable
     */
    protected $Subjects;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.Admin.Subjects',
        'plugin.Admin.Courses',
        'plugin.Admin.SubjectsTeachers',
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
