<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $listingTypeCategory
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Listing Type Category') ?>  
        </h1>
        <small><?php echo __('Here you can view listing type category Detail'); ?></small>
</div>
<?php $this->end(); ?>
<div class="row listingTypeCategories view content">
<div class="col-12 col-sm-12 col-md-12">
    <div class="panel-default">
        <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= h($listingTypeCategory->title) ?></h2>
                <div class="d-flex flex-wrap">
                    <?= $this->Html->link("<i class=\"fa fa-edit\"></i> " . __('Edit Listing Type Category'), ['action' => 'add', $listingTypeCategory->id], ['class' => 'btn btn-block btn-success btn-sm btn-flat mrg-r20', 'escape' => false]) ?>
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>
            <div class="panel-body">
<table class="table table-hover table-bordered">
                <tr>
                    <th width="20%"><?= __('Listing Type') ?></th>
                    <td><?= $listingTypeCategory->has('listing_type') ? $this->Html->link($listingTypeCategory->listing_type->title, ['controller' => 'ListingTypes', 'action' => 'view', $listingTypeCategory->listing_type->id]) : '' ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Title') ?></th>
                    <td><?= h($listingTypeCategory->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($listingTypeCategory->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Sort Order') ?></th>
                    <td><?= $this->Number->format($listingTypeCategory->sort_order) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td>
                        <?php if ($listingTypeCategory->created) {
                                echo $listingTypeCategory->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td>
                        <?php if ($listingTypeCategory->modified) {
                                echo $listingTypeCategory->modified->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
            </table>

        </div>
    </div>
</div>



<?php if (!empty($listingTypeCategory->listing_details)) : ?>
                <div class="col-12 col-sm-12 col-md-12">
                <div class="panel-default">
                    <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                        <h2><?= __('Related Listing Details') ?></h2>
                </div>
                <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Listing Id') ?></th>
                            <th><?= __('Listing Type Category Id') ?></th>
                            <th><?= __('Institution Type Id') ?></th>
                            <th><?= __('Classification') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($listingTypeCategory->listing_details as $listingDetails) : ?>
                        <tr>
                            <td><?= h($listingDetails->id) ?></td>
                            <td><?= h($listingDetails->listing_id) ?></td>
                            <td><?= h($listingDetails->listing_type_category_id) ?></td>
                            <td><?= h($listingDetails->institution_type_id) ?></td>
                            <td><?= h($listingDetails->classification) ?></td>
                            <td><?= h($listingDetails->created) ?></td>
                            <td><?= h($listingDetails->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'ListingDetails', 'action' => 'view', $listingDetails->id], ['class' => 'btn btn-block btn-warning btn-xs btn-flat']) ?> 

                                <?= $this->Html->link(__('Edit'), ['controller' => 'ListingDetails', 'action' => 'edit', $listingDetails->id], ['class' => 'btn btn-block btn-success btn-xs btn-flat']) ?> 

                                <?= $this->Html->link(__('Delete'), 'javascript:void(0)', ['data-message' => __('Are you sure you want to delete # {0}?', $listingDetails->id), 'data-url'=> $this->Url->build(['controller' => 'ListingDetails', 'action' => 'delete', $listingDetails->id]), 'class' => 'deleteWithReload btn btn-block btn-danger btn-xs btn-flat']) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
