<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $microSession
 */


?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $microSession->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $microSession->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Micro Sessions'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="microSessions form content">
            <?= $this->Form->create($microSession) ?>
            <fieldset>
                <legend><?= __('Edit Micro Session') ?></legend>
                <?php
                    // echo $this->Form->control('listing_id', ['options' => $listings]);
                    // echo $this->Form->control('slug');
                    // echo $this->Form->control('user_id', ['options' => $users]);
                    // echo $this->Form->control('parent_id', ['options' => $parentMicroSessions, 'empty' => true]);
                    echo $this->Form->control('grading_type_id', ['options' => $gradingTypes]);
                   // echo $this->Form->control('academic_year_id', ['options' => $academicYears]);
                    echo $this->Form->control('title');
                    echo $this->Form->control('board_id', ['options' => $boards]);
                    echo $this->Form->control('subject_id', ['options' => $subjects]);
                    echo $this->Form->control('duration');
                    echo $this->Form->control('price');
                    echo $this->Form->control('discount_price');
                    echo $this->Form->control('is_free');
                    echo $this->Form->control('short_description');
                    echo $this->Form->control('description');
                    echo $this->Form->control('section_name');
                    echo $this->Form->control('code');
                    echo $this->Form->control('start_date');
                    echo $this->Form->control('end_date');
                    echo $this->Form->control('status');
                    echo $this->Form->control('position');
                    echo $this->Form->control('phinxlog._ids', ['options' => $phinxlog]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>



