<?php
declare(strict_types=1);

namespace Listings\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Listings\Model\Table\ListingsTable;

/**
 * Listings\Model\Table\ListingsTable Test Case
 */
class ListingsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Listings\Model\Table\ListingsTable
     */
    protected $Listings;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.Listings.Listings',
        'plugin.Listings.AdminUsers',
        'plugin.Listings.ListingTypes',
        'plugin.Listings.Locations',
        'plugin.Listings.AcademicYears',
        'plugin.Listings.InstitutionTypes',
        'plugin.Listings.ListingDetails',
        'plugin.Listings.Roles',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Listings') ? [] : ['className' => ListingsTable::class];
        $this->Listings = TableRegistry::getTableLocator()->get('Listings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Listings);

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
