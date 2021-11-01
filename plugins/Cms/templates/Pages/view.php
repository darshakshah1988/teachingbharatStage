<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $page
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Page'), ['action' => 'edit', $page->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Page'), ['action' => 'delete', $page->id], ['confirm' => __('Are you sure you want to delete # {0}?', $page->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Pages'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Page'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="pages view content">
            <h3><?= h($page->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Listing') ?></th>
                    <td><?= $page->has('listing') ? $this->Html->link($page->listing->title, ['controller' => 'Listings', 'action' => 'view', $page->listing->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($page->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Sub Title') ?></th>
                    <td><?= h($page->sub_title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Slug') ?></th>
                    <td><?= h($page->slug) ?></td>
                </tr>
                <tr>
                    <th><?= __('Short Description') ?></th>
                    <td><?= h($page->short_description) ?></td>
                </tr>
                <tr>
                    <th><?= __('Banner') ?></th>
                    <td><?= h($page->banner) ?></td>
                </tr>
                <tr>
                    <th><?= __('Banner Dir') ?></th>
                    <td><?= h($page->banner_dir) ?></td>
                </tr>
                <tr>
                    <th><?= __('Banner Type') ?></th>
                    <td><?= h($page->banner_type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Meta Title') ?></th>
                    <td><?= h($page->meta_title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Meta Keyword') ?></th>
                    <td><?= h($page->meta_keyword) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($page->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Banner Size') ?></th>
                    <td><?= $this->Number->format($page->banner_size) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($page->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($page->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $page->status ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($page->description)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Meta Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($page->meta_description)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
