<?php
$this->layout = "authdefault";
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $microSession
 */
?>
<div class="White79">
    <div class="GreyBg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 TitleStripp">
                    <div class="col-sm-9">
                        <h2><i class="glyphicon glyphicon-list-alt"></i>
                            <?= $this->Text->truncate($microSession->title, 50,  ['ellipsis' => '...', 'exact' => false]) ?></h2>
                    </div>
                    <div class="col-sm-3">
                        <?php echo $this->Html->link(__('Back'), ['action' => 'index', $microSession->id], ['class' => 'btn btn-success btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                    </div>
                </div>
            </div> 
        </div>
        <div class="container">
            <div class="col-md-12 nopadding mt20">
                    <div class="col-md-12">
                       <table class="table table-hover table-bordered">
               <!--tr>
                    <th><?= __('Slug') ?></th>
                    <td><?= $microSession->slug ?></td>
                </tr>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $microSession->user ? $this->Html->link($microSession->user->id, ['controller' => 'Users', 'action' => 'view', $microSession->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Parent Micro Session') ?></th>
                    <td><?= $microSession->parent_micro_session ? $this->Html->link($microSession->parent_micro_session->title, ['controller' => 'MicroSessions', 'action' => 'view', $microSession->parent_micro_session->id]) : '' ?></td>
                </tr>
                 <tr>
                    <th><?= __('Academic Year') ?></th>
                    <td><?= $microSession->academic_year ? $this->Html->link($microSession->academic_year->title, ['controller' => 'AcademicYears', 'action' => 'view', $microSession->academic_year->id]) : '' ?></td>
                </tr-->
                <tr>
                    <th><?= __('Grade') ?></th>
                    <td><?= $microSession->grading_type ? $this->Html->link($microSession->grading_type->title, ['controller' => 'GradingTypes', 'action' => 'view', $microSession->grading_type->id]) : '' ?></td>
                </tr>
               
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= $microSession->title ?></td>
                </tr>
                <tr>
                    <th><?= __('Board') ?></th>
                    <td><?= $microSession->board ? $this->Html->link($microSession->board->title, ['controller' => 'Boards', 'action' => 'view', $microSession->board->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Subject') ?></th>
                    <td><?= $microSession->subject ? $this->Html->link($microSession->subject->title, ['controller' => 'Subjects', 'action' => 'view', $microSession->subject->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Duration') ?></th>
                    <td><?= $microSession->duration ?></td>
                </tr>
                <tr>
                    <th><?= __('Short Description') ?></th>
                    <td><?= $microSession->short_description ?></td>
                </tr>
                <tr>
                    <th><?= __('Description') ?></th>
                    <td><?= $microSession->description ?></td>
                </tr>
                <tr>
                    <th><?= __('Section Name') ?></th>
                    <td><?= $microSession->section_name ?></td>
                </tr>
                <tr>
                    <th><?= __('Code') ?></th>
                    <td><?= $microSession->code ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($microSession->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Price') ?></th>
                    <td><?= $this->Number->format($microSession->price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Discount Price') ?></th>
                    <td><?= $this->Number->format($microSession->discount_price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Lft') ?></th>
                    <td><?= $this->Number->format($microSession->lft) ?></td>
                </tr>
                <tr>
                    <th><?= __('Rght') ?></th>
                    <td><?= $this->Number->format($microSession->rght) ?></td>
                </tr>
                <tr>
                    <th><?= __('Position') ?></th>
                    <td><?= $this->Number->format($microSession->position) ?></td>
                </tr>
                <tr>
                    <th><?= __('Start Date') ?></th>
                    <td><?= $microSession->start_date ?></td>
                </tr>
                <tr>
                    <th><?= __('End Date') ?></th>
                    <td><?= $microSession->end_date ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= $microSession->created ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= $microSession->modified ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Free') ?></th>
                    <td><?= $microSession->is_free ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $microSession->status ? __('Yes') : __('No'); ?></td>
                </tr>
                        </table>
                        <div class="text">
                            <strong><?= __('Description') ?></strong>
                            <blockquote>
                                <?= $this->Text->autoParagraph($microSession->description); ?>
                            </blockquote>
                        </div>
                    </div>
                    
                </div>
        </div>
    </div>
</div>





