<?php
declare(strict_types=1);

namespace UserManager\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use UserManager\Model\Table\OccupationsTable;

/**
 * UserManager\Model\Table\OccupationsTable Test Case
 */
class OccupationsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \UserManager\Model\Table\OccupationsTable
     */
    protected $Occupations;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.UserManager.Occupations',
        'plugin.UserManager.UserProfiles',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Occupations') ? [] : ['className' => OccupationsTable::class];
        $this->Occupations = $this->getTableLocator()->get('Occupations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Occupations);

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
