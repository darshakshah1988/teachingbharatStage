<?php
declare(strict_types=1);

namespace UserManager\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use UserManager\Model\Table\TeacherSchedulesTable;

/**
 * UserManager\Model\Table\TeacherSchedulesTable Test Case
 */
class TeacherSchedulesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \UserManager\Model\Table\TeacherSchedulesTable
     */
    protected $TeacherSchedules;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.UserManager.TeacherSchedules',
        'plugin.UserManager.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('TeacherSchedules') ? [] : ['className' => TeacherSchedulesTable::class];
        $this->TeacherSchedules = $this->getTableLocator()->get('TeacherSchedules', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->TeacherSchedules);

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
}
