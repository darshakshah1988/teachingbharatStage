<?php
/**
 * @var \App\View\AppView $this
 * @var \Queue\Model\Entity\QueuedJob[]|\Cake\Collection\CollectionInterface $queuedJobs
 */

use Cake\Core\Configure;
use Cake\Core\Plugin;

?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Queued Jobs') ?>
        </h1>
        <small><?php echo __('Here you can manage the queue Jobs'); ?></small>
</div>
<?php $this->end(); ?>


<div class="row pages index content">

<?php
	if (Configure::read('Queue.isSearchEnabled') !== false && Plugin::isLoaded('Search')) {
		echo $this->element('Queue.search');
	}
	?>
	<div class="col-12 col-sm-12 col-md-12">
		 <div class="panel-default">
                    <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                        <h2><?= __('Page List') ?></h2> 
                        <div class="d-flex flex-wrap">
                          <?= $this->Html->link(__d('queue', 'Dashboard'), ['controller' => 'Queue', 'action' => 'index'], ['class' => 'btn btn-success btn-sm btn-flat mrg-r10']) ?>
                          <?php if ($this->Configure->read('debug')) { ?>
								<?= $this->Html->link(__d('queue', 'Import'), ['action' => 'import'], ['class' => 'btn btn-success btn-sm btn-flat']) ?>
							<?php } ?>

                       </div>
                    </div>
                    <div class="panel-body">
                    		<div class="table-responsive">
                    			<table class="table table-bordered">
									<thead>
										<tr>
											<th><?= $this->Paginator->sort('job_type') ?></th>
											<th><?= $this->Paginator->sort('job_group') ?></th>
											<th><?= $this->Paginator->sort('reference') ?></th>
											<th><?= $this->Paginator->sort('created', null, ['direction' => 'desc']) ?></th>
											<th><?= $this->Paginator->sort('notbefore', null, ['direction' => 'desc']) ?></th>
											<th><?= $this->Paginator->sort('fetched', null, ['direction' => 'desc']) ?></th>
											<th><?= $this->Paginator->sort('completed', null, ['direction' => 'desc']) ?></th>
											<th><?= $this->Paginator->sort('failed') ?></th>
											<th><?= $this->Paginator->sort('status') ?></th>
											<th><?= $this->Paginator->sort('priority', null, ['direction' => 'desc']) ?></th>
											<th class="actions"><?= __d('queue', 'Actions') ?></th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($queuedJobs as $queuedJob): 
											$data =  unserialize($queuedJob->data);
											?>
										<tr>
											<td><?= h($queuedJob->job_type) ?>
												<?php if($queuedJob->job_type=="Email"){ ?>
			                                    <br />
												<strong>Hook: <?= h($data['hooks'] ?? "") ?></strong>
			                                    <?php } ?>
												
											</td>
											<td><?= h($queuedJob->job_group) ?: '---'  ?></td>
											<td>
												<?= h($queuedJob->reference) ?: '---' ?>
												<?php if ($queuedJob->data) {
													echo $this->Format->icon('cubes', ['title' => $this->Text->truncate($queuedJob->data, 1000)]);
												}
												?>
											</td>
											<td><?= $this->Time->nice($queuedJob->created) ?></td>
											<td>
												<?= $this->Time->nice($queuedJob->notbefore) ?>
												<br>
												<?php echo $this->QueueProgress->timeoutProgressBar($queuedJob, 8); ?>
												<?php if ($queuedJob->notbefore && $queuedJob->notbefore->isFuture()) {
													echo '<div><small>';
													echo $this->Time->relLengthOfTime($queuedJob->notbefore);
													echo '</small></div>';
												} ?>
											</td>
											<td> 
												<?= $this->Time->nice($queuedJob->fetched) ?>

												<?php if ($queuedJob->fetched) {
													echo '<div><small>';
													echo $this->Time->relLengthOfTime($queuedJob->fetched);
													echo '</small></div>';
												} ?>

												<?php if ($queuedJob->workerkey) { ?>
													<div><small><code><?php echo h($queuedJob->workerkey); ?></code></small></div>
												<?php } ?>
											</td>
											<td><?= $this->Format->ok($this->Time->nice($queuedJob->completed), (bool)$queuedJob->completed) ?></td>
											<td><?= $this->Format->ok($this->Queue->fails($queuedJob), !$queuedJob->failed); ?></td>
											<td>
												<?= h($queuedJob->status) ?>
												<?php if (!$queuedJob->completed && $queuedJob->fetched) { ?>
													<div>
														<?php if (!$queuedJob->failed) { ?>
															<?php echo $this->QueueProgress->progress($queuedJob) ?>
															<br>
															<?php
															$textProgressBar = $this->QueueProgress->progressBar($queuedJob, 8);
															echo $this->QueueProgress->htmlProgressBar($queuedJob, $textProgressBar);
															?>
														<?php } else { ?>
															<i><?php echo $this->Queue->failureStatus($queuedJob); ?></i>
														<?php } ?>
													</div>
												<?php } ?>
											</td>
											<td><?= $this->Number->format($queuedJob->priority) ?></td>
											<td class="actions">
											<?= $this->Html->link($this->Format->icon('view'), ['action' => 'view', $queuedJob->id], ['escapeTitle' => false, 'class' => 'btn btn-block btn-warning btn-xs btn-flat mrg-r10']); ?>

											<?php if (!$queuedJob->completed) { ?>
												<?= $this->Html->link('<i class="fa fa-edit"></i>', ['action' => 'edit', $queuedJob->id], ['escapeTitle' => false, 'class' => 'btn btn-block btn-success btn-xs btn-flat mrg-r10']); ?>
											<?php } ?>
											<?= $this->Form->postLink($this->Format->icon('delete'), ['action' => 'delete', $queuedJob->id], ['escapeTitle' => false, 'confirm' => __d('queue', 'Are you sure you want to delete # {0}?', $queuedJob->id), 'class' => 'btn btn-block btn-danger btn-xs btn-flat']); ?>
											</td>
										</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
                    		</div>
                    		<div class="pagination-sec justify-content-between flex-wrap align-items-center">
                            <?php echo $this->element('Tools.pagination'); ?>
                        </div>
                    </div>
                </div>
	</div>
</div>



