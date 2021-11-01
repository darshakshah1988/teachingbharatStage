<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $package
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
            <?= $this->Html->link(__('Edit Package'), ['action' => 'edit', $package->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Package'), ['action' => 'delete', $package->id], ['confirm' => __('Are you sure you want to delete # {0}?', $package->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Packages'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Package'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="packages view content">
            <h3><?= h($package->id) ?></h3>

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
                    <th><?= __('Package Name') ?></th>
                    <td><?= h($package->package_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Package Title') ?></th>
                    <td><?= h($package->package_title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Grading Type Id') ?></th>
                    <td><?= $this->Number->format($package->grading_type_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Board Id') ?></th>
                    <td><?= $this->Number->format($package->board_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Subject Id') ?></th>
                    <td><?= $this->Number->format($package->subject_id) ?></td>
                </tr>

                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $package->status ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                            <strong><?= __('Short Description') ?></strong>
                            <blockquote>
                                <?= $this->Text->autoParagraph($package->short_description); ?>
                            </blockquote>
                        </div>
                        <div class="text">
                            <strong><?= __('Description') ?></strong>
                            <blockquote>
                                <?= $this->Text->autoParagraph($package->description); ?>
                            </blockquote>
                        </div>
                    </div>

                </div>
        </div>
    </div>
</div>
