<?php
declare(strict_types=1);

namespace Testimonials\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Testimonials\Model\Table\TestimonialsTable;

/**
 * Testimonials\Model\Table\TestimonialsTable Test Case
 */
class TestimonialsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Testimonials\Model\Table\TestimonialsTable
     */
    protected $Testimonials;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.Testimonials.Testimonials',
        'plugin.Testimonials.Listings',
        'plugin.Testimonials.Phinxlog',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Testimonials') ? [] : ['className' => TestimonialsTable::class];
        $this->Testimonials = TableRegistry::getTableLocator()->get('Testimonials', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Testimonials);

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
