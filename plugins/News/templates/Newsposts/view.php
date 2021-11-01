<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $newspost
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Newspost') ?>  
        </h1>
        <small><?php echo __('Here you can view newspost Detail'); ?></small>
</div>
<?php $this->end(); ?>
<div class="row newsposts view content">
<div class="col-12 col-sm-12 col-md-12">
    <div class="panel-default">
        <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= h($newspost->title) ?></h2>
                <div class="d-flex flex-wrap">
                    <?= $this->Html->link("<i class=\"fa fa-edit\"></i> " . __('Edit Newspost'), ['action' => 'add', $newspost->id], ['class' => 'btn btn-block btn-success btn-sm btn-flat mrg-r20', 'escape' => false]) ?>
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>
            <div class="panel-body">
<table class="table table-hover table-bordered">
                <tr>
                    <th width="20%"><?= __('Title') ?></th>
                    <td><?= h($newspost->title) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Slug') ?></th>
                    <td><?= h($newspost->slug) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Short Description') ?></th>
                    <td><?= h($newspost->short_description) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Banner Image') ?></th>
                    <td><?= h($newspost->banner_image) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Banner Dir') ?></th>
                    <td><?= h($newspost->banner_dir) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Banner Size') ?></th>
                    <td><?= h($newspost->banner_size) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Banner Type') ?></th>
                    <td><?= h($newspost->banner_type) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Header Image') ?></th>
                    <td><?= h($newspost->header_image) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Header Dir') ?></th>
                    <td><?= h($newspost->header_dir) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Header Type') ?></th>
                    <td><?= h($newspost->header_type) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Meta Title') ?></th>
                    <td><?= h($newspost->meta_title) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Meta Keyword') ?></th>
                    <td><?= h($newspost->meta_keyword) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($newspost->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Listing Id') ?></th>
                    <td><?= $this->Number->format($newspost->listing_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Admin User Id') ?></th>
                    <td><?= $this->Number->format($newspost->admin_user_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Header Size') ?></th>
                    <td><?= $this->Number->format($newspost->header_size) ?></td>
                </tr>
                <tr>
                    <th><?= __('Position') ?></th>
                    <td><?= $this->Number->format($newspost->position) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td>
                        <?php if ($newspost->created) {
                                echo $newspost->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td>
                        <?php if ($newspost->modified) {
                                echo $newspost->modified->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $newspost->status ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($newspost->description)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Meta Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($newspost->meta_description)); ?>
                </blockquote>
            </div>

        </div>
    </div>
</div>



