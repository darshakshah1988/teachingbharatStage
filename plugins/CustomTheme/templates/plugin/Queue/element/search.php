<?php
/**
 * @var \App\View\AppView $this
 * @var mixed $_isSearch
 */
?>
<div class="col-12 col-sm-12 col-md-12">
	 <div class="panel-default">
	 	<div class="panel-body">
	 	<?php echo $this->Form->create(null, ['valueSources' => 'query', 'templates' => 'default_form']);?>
		<div class="row">
			<div class="col-md-3">
				<?php echo $this->Form->control('search', ['placeholder' => 'Auto-wildcard mode (Jobgroup/Reference)','class' => 'form-control', 'label' => 'Jobgroup/Reference']); ?>
			</div>
			<div class="col-md-3">
				<?php echo $this->Form->control('job_type', ['empty' => ' - no filter - ','class' => 'form-control']); ?>
			</div>
			<div class="col-md-3">
				<?php echo $this->Form->control('status', ['options' => ['completed' => 'Completed', 'in_progress' => 'In Progress'], 'empty' => ' - no filter - ','class' => 'form-control']); ?>
			</div>
			<div class="col-md-3">
				<label for="button">&nbsp;</label>
				<?php
					echo $this->Form->button('Filter', ['type' => 'submit', 'class' => 'btn btn-block btn-success btn-sm']);
					if (!empty($_isSearch)) {
						echo $this->Html->link('Reset', ['action' => 'index'], ['class' => 'btn btn-block btn-success btn-sm button']);
					}
			?>
			</div>
		</div>
		<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>
