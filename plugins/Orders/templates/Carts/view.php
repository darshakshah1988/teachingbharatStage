<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $cart
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Cart'), ['action' => 'edit', $cart->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Cart'), ['action' => 'delete', $cart->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cart->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Carts'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Cart'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="carts view content">
            <h3><?= h($cart->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $cart->has('user') ? $this->Html->link($cart->user->id, ['controller' => 'Users', 'action' => 'view', $cart->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('SessionId') ?></th>
                    <td><?= h($cart->sessionId) ?></td>
                </tr>
                <tr>
                    <th><?= __('Course') ?></th>
                    <td><?= $cart->has('course') ? $this->Html->link($cart->course->title, ['controller' => 'Courses', 'action' => 'view', $cart->course->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($cart->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Quantity') ?></th>
                    <td><?= $this->Number->format($cart->quantity) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($cart->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($cart->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
