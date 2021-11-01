<?php
declare(strict_types=1);

namespace Listings\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Listings\Model\Table\ListingTypesTable;

/**
 * Listings\Model\Table\ListingTypesTable Test Case
 */
class ListingTypesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Listings\Model\Table\ListingTypesTable
     */
    protected $ListingTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.Listings.ListingTypes',
        'plugin.Listings.ListingTypeCategories',
        'plugin.Listings.Listings',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ListingTypes') ? [] : ['className' => ListingTypesTable::class];
        $this->ListingTypes = TableRegistry::getTableLocator()->get('ListingTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->ListingTypes);

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
