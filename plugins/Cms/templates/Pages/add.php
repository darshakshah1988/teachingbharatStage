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
            <?= $this->Html->link(__('List Pages'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="pages form content">
            <?= $this->Form->create($page) ?>
            <fieldset>
                <legend><?= __('Add Page') ?></legend>
                <?php
                    echo $this->Form->control('listing_id', ['options' => $listings]);
                    echo $this->Form->control('title');
                    echo $this->Form->control('sub_title');
                    echo $this->Form->control('slug');
                    echo $this->Form->control('short_description');
                    echo $this->Form->control('description');
                    echo $this->Form->control('banner');
                    echo $this->Form->control('banner_dir');
                    echo $this->Form->control('banner_size');
                    echo $this->Form->control('banner_type');
                    echo $this->Form->control('meta_title');
                    echo $this->Form->control('meta_keyword');
                    echo $this->Form->control('meta_description');
                    echo $this->Form->control('status');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
