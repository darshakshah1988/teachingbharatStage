<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $listings
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Listing') ?>
        </h1>
        <small><?php echo __('Here you can manage the listings'); ?></small>
</div>
<?php $this->end(); ?>
<div class="row listings index content">

<div class="col-12 col-sm-12 col-md-12">
                <div class="panel-default">
                    <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                        <h2><?= __('listing') ?> List</h2>
                        <div class="d-flex flex-wrap">
                           <?= $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('New Listing'), ["action" => "quickAdd"], ["class" => "btn btn-block btn-primary btn-sm btn-flat quickAdd", "escape" => false]) ?>
                       </div>
                    </div>
                    <div class="panel-body">

                        <div class="table-responsive">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <th>#</th>

                     <th><?= $this->Paginator->sort('admin_user_id') ?></th>

                     <th><?= $this->Paginator->sort('listing_type_id') ?></th>

                     <th><?= $this->Paginator->sort('title') ?></th>

                     <th><?= $this->Paginator->sort('domain_name') ?></th>

                     <th><?= $this->Paginator->sort('status') ?></th>

                     <th><?= $this->Paginator->sort('created') ?></th>

                            <?php if($this->request->getAttribute('identity')->is_supper_admin == 1){ ?>
                                  <th class="action-col">Action</th>
                                <?php } ?>
                                </tr>
                              </thead>
                              <tbody>
                                <?php if (!empty($listings->toArray())):
                                    $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                                    foreach ($listings as $listing): ?>
                                 <tr>
                                    <td><?= $this->Number->format($i) ?>.</td>
                                    <td><?= $this->Number->format($listing->admin_user_id) ?></td>
                                    <td><?= $listing->has('listing_type') ? $this->Html->link($listing->listing_type->title, ['controller' => 'ListingTypes', 'action' => 'view', $listing->listing_type->id]) : '' ?></td>
                                    <td>
                                        <?= h($listing->title) ?> (<?= h($listing->code) ?>)
                                        <?= h($listing->tag_line) ?>
                                    </td>
                                    <td><?= h($listing->protocol) ?><?= h($listing->domain_name) ?></td>
                                    <td>
                                    <?php if ($listing->status == 1) {
                                            echo "Yes";
                                        }else{
                                            echo "No";
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php if ($listing->created) {
                                        echo $listing->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                        }
                                    ?>
                                </td>

<?php if($this->request->getAttribute('identity')->is_supper_admin == 1){ ?>
                            <td class="action-col">
                <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['action' => 'view', $listing->id],['class' => 'btn btn-block btn-warning btn-xs btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('View listing'),'title'=>__('View listing')]) ?>

                <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['action' => 'add', $listing->id], ['class' => 'btn btn-block btn-success btn-xs btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit listing'),'title'=>__('Edit listing')]) ?>

                <?= $this->Html->link("<i class=\"fa fa-trash\"></i>", 'javascript:void(0)', ['class' => 'deleteWithReload btn btn-block btn-danger btn-xs btn-flat', 'data-url'=> $this->Url->build(['action' => 'delete', $listing->id]), 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit listing'),'title'=>__('Delete listing')]) ?>
                    </td>
                  <?php } ?>
                </tr>
                                <?php $i++; endforeach; ?>
                            <?php else: ?>
                            <tr> <td colspan='39' align='center' class="tbodyNotFound" style="text-align:center;"> <strong>Record Not Available</strong> </td> </tr>
                            <?php endif; ?>
                              </tbody>
                            </table>
                        </div>
                        <div class="pagination-sec d-flex justify-content-between flex-wrap align-items-center">
                            <?php echo $this->element('pagination'); ?>
                        </div>
                    </div>
                </div>
            </div>

<?php echo $this->Html->script('listing',['block' => true]) ?>
