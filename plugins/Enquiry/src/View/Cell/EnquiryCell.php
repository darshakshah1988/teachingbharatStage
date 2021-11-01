<?php
declare(strict_types=1);

namespace Enquiry\View\Cell;

use Cake\View\Cell;
use Cake\ORM\TableRegistry;
/**
 * Enquiry cell
 */
class EnquiryCell extends Cell
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
    public function display($options)
    {
        $query = TableRegistry::getTableLocator()->get('Enquiry.Enquiries')->find();
        $query->contain(['Listings', 'AdminUsers', 'PriorityTypes', 'EnquiryStatuses', 'AssignedUsers', 'LatestComment' => [
            'strategy' => 'select',
            'queryBuilder' => function ($q) {
                return $q->order(['LatestComment.created' =>'DESC'])->contain(['EnquiryStatuses'])->limit(1);
            }
        ]]);
        $query->where(function ($exp, $q) use($options){
            return $exp->or([
                'Enquiries.admin_user_id' => $options['admin_user_id'],
                'Enquiries.assigned_user_id' => $options['admin_user_id']
            ]);
        });
        $query->order(['PriorityTypes.position' => 'DESC']);
        $query->limit(15);
        $enquiries = $query->all();
        $this->set(compact('enquiries'));
    }
}
