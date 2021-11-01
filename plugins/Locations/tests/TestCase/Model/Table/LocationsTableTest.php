<?php
declare(strict_types=1);

namespace Locations\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use Locations\Model\Table\LocationsTable;

/**
 * Locations\Model\Table\LocationsTable Test Case
 */
class LocationsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Locations\Model\Table\LocationsTable
     */
    protected $Locations;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.Locations.Locations',
        'plugin.Locations.Listings',
        'plugin.Locations.UserProfiles',
        'plugin.Locations.Phinxlog',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Locations') ? [] : ['className' => LocationsTable::class];
        $this->Locations = $this->getTableLocator()->get('Locations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Locations);

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
