<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $adminUsers
 */
?>
<div class="adminUsers index content">
    <?= $this->Html->link(__('New Admin User'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Admin Users') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('listing_id') ?></th>
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <th><?= $this->Paginator->sort('first_name') ?></th>
                    <th><?= $this->Paginator->sort('middle_name') ?></th>
                    <th><?= $this->Paginator->sort('last_name') ?></th>
                    <th><?= $this->Paginator->sort('mobile') ?></th>
                    <th><?= $this->Paginator->sort('dob') ?></th>
                    <th><?= $this->Paginator->sort('email') ?></th>
                    <th><?= $this->Paginator->sort('password') ?></th>
                    <th><?= $this->Paginator->sort('profile_photo') ?></th>
                    <th><?= $this->Paginator->sort('photo_dir') ?></th>
                    <th><?= $this->Paginator->sort('photo_size') ?></th>
                    <th><?= $this->Paginator->sort('photo_type') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th><?= $this->Paginator->sort('is_verified') ?></th>
                    <th><?= $this->Paginator->sort('login_count') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($adminUsers as $adminUser): ?>
                <tr>
                    <td><?= $this->Number->format($adminUser->id) ?></td>
                    <td><?= $this->Number->format($adminUser->listing_id) ?></td>
                    <td><?= h($adminUser->title) ?></td>
                    <td><?= h($adminUser->first_name) ?></td>
                    <td><?= h($adminUser->middle_name) ?></td>
                    <td><?= h($adminUser->last_name) ?></td>
                    <td><?= h($adminUser->mobile) ?></td>
                    <td><?= h($adminUser->dob) ?></td>
                    <td><?= h($adminUser->email) ?></td>
                    <td><?= h($adminUser->password) ?></td>
                    <td><?= h($adminUser->profile_photo) ?></td>
                    <td><?= h($adminUser->photo_dir) ?></td>
                    <td><?= $this->Number->format($adminUser->photo_size) ?></td>
                    <td><?= h($adminUser->photo_type) ?></td>
                    <td><?= h($adminUser->status) ?></td>
                    <td><?= h($adminUser->is_verified) ?></td>
                    <td><?= $this->Number->format($adminUser->login_count) ?></td>
                    <td><?= h($adminUser->created) ?></td>
                    <td><?= h($adminUser->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $adminUser->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $adminUser->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $adminUser->id], ['confirm' => __('Are you sure you want to delete # {0}?', $adminUser->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
