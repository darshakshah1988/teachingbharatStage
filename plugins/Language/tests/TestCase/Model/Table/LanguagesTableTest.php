<?php
declare(strict_types=1);

namespace Language\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use Language\Model\Table\LanguagesTable;

/**
 * Language\Model\Table\LanguagesTable Test Case
 */
class LanguagesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Language\Model\Table\LanguagesTable
     */
    protected $Languages;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.Language.Languages',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Languages') ? [] : ['className' => LanguagesTable::class];
        $this->Languages = $this->getTableLocator()->get('Languages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Languages);

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
