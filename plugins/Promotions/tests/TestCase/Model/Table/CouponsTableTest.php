<?php
declare(strict_types=1);

namespace Promotions\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use Promotions\Model\Table\CouponsTable;

/**
 * Promotions\Model\Table\CouponsTable Test Case
 */
class CouponsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Promotions\Model\Table\CouponsTable
     */
    protected $Coupons;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.Promotions.Coupons',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Coupons') ? [] : ['className' => CouponsTable::class];
        $this->Coupons = $this->getTableLocator()->get('Coupons', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Coupons);

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
