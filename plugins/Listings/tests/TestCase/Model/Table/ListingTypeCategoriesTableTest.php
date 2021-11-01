<?php
declare(strict_types=1);

namespace Listings\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Listings\Model\Table\ListingTypeCategoriesTable;

/**
 * Listings\Model\Table\ListingTypeCategoriesTable Test Case
 */
class ListingTypeCategoriesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Listings\Model\Table\ListingTypeCategoriesTable
     */
    protected $ListingTypeCategories;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.Listings.ListingTypeCategories',
        'plugin.Listings.ListingTypes',
        'plugin.Listings.ListingDetails',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ListingTypeCategories') ? [] : ['className' => ListingTypeCategoriesTable::class];
        $this->ListingTypeCategories = TableRegistry::getTableLocator()->get('ListingTypeCategories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->ListingTypeCategories);

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
