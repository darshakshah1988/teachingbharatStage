<?php
declare(strict_types=1);

namespace Testimonials\View\Cell;

use Cake\View\Cell;
use Cake\ORM\TableRegistry;
/**
 * Testimonial cell
 */
class TestimonialCell extends Cell
{
    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Initialization logic run at the end of object construction.
     *
     * @return void
     */
    public function initialize(): void
    {
    }

    /**
     * Default display method.
     *
     * @return void
     */
    public function display()
    {
        $query = TableRegistry::getTableLocator()->get('Testimonials.Testimonials')->find();
        $query->order(['Testimonials.id' => 'desc']);
        $query->limit(15);
        $testimonials = $query->all();
        $this->set(compact('testimonials'));
    }
}
