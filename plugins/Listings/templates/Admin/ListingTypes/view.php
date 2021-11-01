<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $listingType
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Listing Type') ?>  
        </h1>
        <small><?php echo __('Here you can view listing type Detail'); ?></small>
</div>
<?php $this->end(); ?>
<div class="row listingTypes view content">
<div class="col-12 col-sm-12 col-md-12">
    <div class="panel-default">
        <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= h($listingType->title) ?></h2>
                <div class="d-flex flex-wrap">
                    <?= $this->Html->link("<i class=\"fa fa-edit\"></i> " . __('Edit Listing Type'), ['action' => 'add', $listingType->id], ['class' => 'btn btn-block btn-success btn-sm btn-flat mrg-r20', 'escape' => false]) ?>
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>
            <div class="panel-body">
<table class="table table-hover table-bordered">
                <tr>
                    <th width="20%"><?= __('Title') ?></th>
                    <td><?= h($listingType->title) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Slug') ?></th>
                    <td><?= h($listingType->slug) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($listingType->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Sort Order') ?></th>
                    <td><?= $this->Number->format($listingType->sort_order) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td>
                        <?php if ($listingType->created) {
                                echo $listingType->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td>
                        <?php if ($listingType->modified) {
                                echo $listingType->modified->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
            </table>

        </div>
    </div>
</div>



<?php if (!empty($listingType->listing_type_categories)) : ?>
                <div class="col-12 col-sm-12 col-md-12">
                <div class="panel-default">
                    <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                        <h2><?= __('Related Listing Type Categories') ?></h2>
                </div>
                <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Listing Type Id') ?></th>
                            <th><?= __('Title') ?></th>
                            <th><?= __('Sort Order') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($listingType->listing_type_categories as $listingTypeCategories) : ?>
                        <tr>
                            <td><?= h($listingTypeCategories->id) ?></td>
                            <td><?= h($listingTypeCategories->listing_type_id) ?></td>
                            <td><?= h($listingTypeCategories->title) ?></td>
                            <td><?= h($listingTypeCategories->sort_order) ?></td>
                            <td><?= h($listingTypeCategories->created) ?></td>
                            <td><?= h($listingTypeCategories->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'ListingTypeCategories', 'action' => 'view', $listingTypeCategories->id], ['class' => 'btn btn-block btn-warning btn-xs btn-flat']) ?> 

                                <?= $this->Html->link(__('Edit'), ['controller' => 'ListingTypeCategories', 'action' => 'edit', $listingTypeCategories->id], ['class' => 'btn btn-block btn-success btn-xs btn-flat']) ?> 

                                <?= $this->Html->link(__('Delete'), 'javascript:void(0)', ['data-message' => __('Are you sure you want to delete # {0}?', $listingTypeCategories->id), 'data-url'=> $this->Url->build(['controller' => 'ListingTypeCategories', 'action' => 'delete', $listingTypeCategories->id]), 'class' => 'deleteWithReload btn btn-block btn-danger btn-xs btn-flat']) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

