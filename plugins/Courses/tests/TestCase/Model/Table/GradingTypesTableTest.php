<?php
declare(strict_types=1);

namespace Courses\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use Courses\Model\Table\GradingTypesTable;

/**
 * Courses\Model\Table\GradingTypesTable Test Case
 */
class GradingTypesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Courses\Model\Table\GradingTypesTable
     */
    protected $GradingTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.Courses.GradingTypes',
        'plugin.Courses.Listings',
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
        $config = $this->getTableLocator()->exists('GradingTypes') ? [] : ['className' => GradingTypesTable::class];
        $this->GradingTypes = $this->getTableLocator()->get('GradingTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->GradingTypes);

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
