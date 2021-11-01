<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $event
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Events'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="events form content">
            <?= $this->Form->create($event) ?>
            <fieldset>
                <legend><?= __('Add Event') ?></legend>
                <?php
                    echo $this->Form->control('admin_user_id', ['options' => $adminUsers]);
                    echo $this->Form->control('listing_id', ['options' => $listings]);
                    echo $this->Form->control('title');
                    echo $this->Form->control('slug');
                    echo $this->Form->control('sub_title');
                    echo $this->Form->control('short_description');
                    echo $this->Form->control('description');
                    echo $this->Form->control('location');
                    echo $this->Form->control('organizar_name');
                    echo $this->Form->control('organizer_email');
                    echo $this->Form->control('organizer_contact_number');
                    echo $this->Form->control('banner');
                    echo $this->Form->control('banner_dir');
                    echo $this->Form->control('banner_size');
                    echo $this->Form->control('banner_type');
                    echo $this->Form->control('start_date');
                    echo $this->Form->control('end_date');
                    echo $this->Form->control('meta_title');
                    echo $this->Form->control('meta_keyword');
                    echo $this->Form->control('meta_description');
                    echo $this->Form->control('status');
                    echo $this->Form->control('position');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
