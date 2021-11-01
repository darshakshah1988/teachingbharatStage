<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $plan
 */
?>
<div class="White79">
    <div class="GreyBg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 TitleStripp">
                   <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Plan'), ['action' => 'edit', $plan->id,$package_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Plan'), ['action' => 'delete', $plan->id], ['confirm' => __('Are you sure you want to delete # {0}?', $plan->id,$package_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Plans'), ['action' => 'index',$package_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Plan'), ['action' => 'add',$package_id], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="Plans view content">
            <h3><?= h($plan->id) ?></h3>
           
        </div>
    </div>
                </div>
            </div> 
        </div>
        <div class="container">
            <div class="col-md-12 nopadding mt20">
                    <div class="col-md-12">
                       <table class="table table-hover table-bordered">                      
               
                <tr>
                    <th><?= __('Plan Name') ?></th>
                    <td><?= h($plan->plan_name) ?></td>
                </tr>
                  <tr>
                    <th><?= __('Price') ?></th>
                    <td><?= $this->Number->format($plan->price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Discount Price') ?></th>
                    <td><?= $this->Number->format($plan->discount_price) ?></td>
                </tr>
               <tr>
                    <th><?= __('Duration') ?></th>
                    <td><?= h($plan->duration) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $plan->status ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">                
                            <strong><?= __('Features') ?></strong>
                            <blockquote>
                                <?= $this->Text->autoParagraph($plan->features); ?>
                            </blockquote>
                        </div>
                        <div class="text">
                            <strong><?= __('Description') ?></strong>
                            <blockquote>
                                <?= $this->Text->autoParagraph($plan->other_details); ?>
                            </blockquote>
                        </div>
                    </div>
                    
                </div>
        </div>
    </div>
</div>






