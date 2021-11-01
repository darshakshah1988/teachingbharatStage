<?php
/**
 * @var \App\View\AppView $this
 * @var \Queue\Model\Entity\QueuedJob[] $pendingDetails
 * @var string[] $tasks
 * @var string[] $servers
 * @var array $status
 * @var int $new
 * @var int $current
 * @var array $data
 */
use Cake\Core\Configure;
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Queue Email') ?>
        </h1>
        <small><?php echo __('Here you can manage the email queue'); ?></small>
</div>
<?php $this->end(); ?>

<div class="row">
 <div class="col-8 col-sm-12 col-md-8">
	 	<div class="d-block">
	        <div class="panel-default emailHooks">
	        	<div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
	        		<h2><?php echo __d('queue', 'Queue');?></h2>
	        		<div class="d-flex flex-wrap">
					<?php echo $this->Form->postLink(__d('queue', 'Reset {0}', __d('queue', 'Failed Jobs')), ['action' => 'reset'], ['confirm' => __d('queue', 'Sure? This will make all failed jobs ready for re-run.'), 'class' => 'btn btn-default btn-sm btn-flat mrg-r10']); ?>
					<?php echo $this->Form->postLink(__d('queue', 'Reset {0}', __d('queue', 'All Jobs')), ['action' => 'reset', '?' => ['full' => true]], ['confirm' => __d('queue', 'Sure? This will make all failed as well as still running jobs ready for re-run.'), 'class' => 'btn btn-default btn-sm btn-flat mrg-r10']); ?>
					<?php echo $this->Form->postLink(__d('queue', 'Hard Reset {0}', __d('queue', 'Queue')), ['action' => 'hardReset'], ['confirm' => __d('queue', 'Sure? This will delete all jobs and completely reset the queue.'), 'class' => 'btn btn-warning btn-sm btn-flat mrg-r10']); ?>
					<?php echo $this->Html->link(__d('queue', 'List {0}', __d('queue', 'Queued Jobs')), ['controller' => 'QueuedJobs', 'action' => 'index'], ['class' => 'btn btn-success btn-sm btn-flat']); ?>
	        		</div>
	        	</div>
	        <div class="panel-body">

	        	<div class="timeline">
	        		 <!-- timeline time label -->
                    <div class="time-label">
                        <span class="bg-red"><?php echo __d('queue', 'Workers Status'); ?></span>
                    </div>
                    <!-- /.timeline-label -->
	        		<div>
                    <i class="fas fa-anchor bg-blue"></i>
	                     <div class="timeline-item">
	                     	<h3 class="timeline-header"><?php echo __d('queue', 'Status'); ?></h3>
	                     	<div class="clearfix"></div>
	                     	<div class="timeline-body">
	                 		<?php if ($status) { ?>
								<?php
								/** @var \Cake\I18n\FrozenTime $time */
								$time = $status['time'];
								$running = $time->addMinute()->isFuture();
								?>
								<?php echo $this->Format->yesNo($running); ?> <?php echo $running ? __d('queue', 'Running') : __d('queue', 'Not running'); ?> (<?php echo __d('queue', 'last {0}', $this->Time->relLengthOfTime($status['time']))?>)

								<?php
								echo '<div><small>Currently ' . $this->Html->link($status['workers'] . ' worker(s)', ['action' => 'processes']) . ' total.</small></div>';
								?>
								<?php
								echo '<div><small>' . count($servers) . ' CLI server(s): ' . implode(', ', $servers) .'</small></div>';
								?>

							<?php } else { ?>
								n/a
							<?php } ?>
	                     	</div>
	                     </div>
                 	</div>

                 	<div class="time-label">
                        <span class="bg-red"><?php echo __d('queue', 'Queued Jobs'); ?></span>
                    </div>
                    <div>
						<i class="fas fa-anchor bg-blue"></i>
						<div class="timeline-item">
	                     	<h3 class="timeline-header"><?php echo __d('queue', 'Queued Jobs'); ?></h3>
	                     	<div class="clearfix"></div>
	                 		<div class="timeline-body">      	
	                 			<p>
								<?php echo __d('queue', '{0} task(s) newly await processing.', $new . '/' . $current); ?>
								</p>
								<ol>
								<?php
								foreach ($pendingDetails as $pendingJob) {
									echo '<li>' . $this->Html->link($pendingJob->job_type, ['controller' => 'QueuedJobs', 'action' => 'view', $pendingJob->id]) . ' (ref <code>' . h($pendingJob->reference ?: '-') . '</code>, prio ' . $pendingJob->priority . '):';
									echo '<ul>';

									$reset = '';
									if ($this->Queue->hasFailed($pendingJob)) {
										$reset = ' ' . $this->Form->postLink(__d('queue', 'Soft reset'), ['action' => 'resetJob', $pendingJob->id], ['confirm' => 'Sure?', 'class' => 'button primary btn margin btn-primary']);
										$reset .= ' ' . $this->Form->postLink(__d('queue', 'Remove'), ['action' => 'removeJob', $pendingJob->id], ['confirm' => 'Sure?', 'class' => 'button secondary btn margin btn-default']);
									} elseif ($pendingJob->fetched) {
										$reset .= ' ' . $this->Form->postLink(__d('queue', 'Remove'), ['action' => 'removeJob', $pendingJob->id], ['confirm' => 'Sure?', 'class' => 'button secondary btn margin btn-default']);
									}

									$notBefore = '';
									if ($pendingJob->notbefore) {
										$notBefore = ' (' . __d('queue', 'scheduled {0}', $this->Time->nice($pendingJob->notbefore)) . ')';
									}

									echo '<li>' . __d('queue', 'Created') . ': ' . $this->Time->nice($pendingJob->created) . $notBefore . '</li>';

									if ($pendingJob->fetched) {
										echo '<li>' . __d('queue', 'Fetched') . ': ' . $this->Time->nice($pendingJob->fetched) . '</li>';

										$status = '';
										if ($pendingJob->status) {
											$status = ' (' . __d('queue', 'status') . ': ' . h($pendingJob->status) . ')';
										}

										if (!$pendingJob->failed || !$pendingJob->failure_message) {
											echo '<li>';
											echo __d('queue', 'Progress') . ': ';
											echo $this->QueueProgress->progress($pendingJob) . $status;
											$textProgressBar = $this->QueueProgress->progressBar($pendingJob, 18);
											echo '<br>' . $this->QueueProgress->htmlProgressBar($pendingJob, $textProgressBar);
											echo '</li>';
										} else {
											echo '<li><i>' . $this->Queue->failureStatus($pendingJob) . '</i>';
					  						echo '<div>' . __d('queue', 'Failures') . ': ' . $this->Queue->fails($pendingJob) . $reset . '</div>';
					  						echo '</li>';
											if ($pendingJob->failure_message) {
												echo '<li>' . __d('queue', 'Failure Message') . ': ' . $this->Text->truncate($pendingJob->failure_message, 200) . '</li>';
											}
										}
									}

									echo '</ul>';
									echo '</li>';
								}
								?>
							</ol>
	                 		</div>
	                     </div>
					</div>
                 	<div class="time-label">
                        <span class="bg-red"><?php echo __d('queue', 'Statistics'); ?></span>
                	</div>
                     <div>
                     	<i class="fas fa-anchor bg-blue"></i>
	                     <div class="timeline-item">
	                     	<h3 class="timeline-header"><?php echo __d('queue', 'Statistics'); ?></h3>
	                     	<div class="clearfix"></div>
	                 		<div class="timeline-body">
	                 			<ul>
									<?php
									foreach ($data as $row) {
										echo '<li>' . h($row['job_type']) . ':';
										echo '<ul>';
										echo '<li>Finished Jobs in Database: ' . $row['num'] . '</li>';
										echo '<li>Average Job existence: ' . $row['alltime'] . 's</li>';
										echo '<li>Average Execution delay: ' . $row['fetchdelay'] . 's</li>';
										echo '<li>Average Execution time: ' . $row['runtime'] . 's</li>';
										echo '</ul>';
										echo '</li>';
									}
									if (empty($data)) {
										echo 'n/a';
									}
									?>
								</ul>
								<?php if (Configure::read('Queue.isStatisticEnabled')) { ?>
									<p><?php echo $this->Html->link(__d('queue', 'Detailed Statistics'), ['controller' => 'QueuedJobs', 'action' => 'stats']); ?></p>
									<?php } ?>
	                 		</div>
	                 	</div>
                 	</div>

	        	</div>

	        	
	        </div>
    	</div>
 </div>


</div>

<div class="col-md-4">
	<div class="d-block">
	    <div class="panel-default">
	    	<div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                    <h2 class="box-title"><i class="fa fa-anchor"></i> Settings</h2>
            </div>	
            <div class="panel-body">
            	Server:
				<ul>
					<li>
						<code>posix</code> extension enabled (optional, recommended): <?php echo $this->Format->yesNo(function_exists('posix_kill')); ?>
					</li>
				</ul>

		Current runtime configuration:
		<ul>
			<?php
			$configurations = (array)Configure::read('Queue');
			if (!$configurations) {
				echo '<b>No configuration found</b>';
			}

			foreach ($configurations as $key => $configuration) {
				echo '<li>';
				if (is_dir($configuration)) {
					$configuration = str_replace(ROOT . DS, 'ROOT' . DS, $configuration);
					$configuration = str_replace(DS, '/', $configuration);
				} elseif (is_bool($configuration)) {
					$configuration = $configuration ? 'true' : 'false';
				}
				echo h($key) . ': ' . h($configuration);
				echo '</li>';
			}

			?>
		</ul>

		<h2>Trigger Test/Demo Jobs</h2>
		<ul>
			<?php
			foreach ($tasks as $task) {
				if (substr($task, 0, 11) !== 'Queue.Queue') {
					continue;
				}
				if (substr($task, -7) !== 'Example') {
					continue;
				}

				echo '<li>';
				echo $this->Form->postLink($task, ['action' => 'addJob', substr($task, 11)], ['confirm' => 'Sure?']);
				echo '</li>';
			}
			?>
		</ul>

		<p><?php echo $this->Html->link(__d('queue', 'Trigger Delayed Test/Demo Job'), ['controller' => 'QueuedJobs', 'action' => 'test']); ?></p>
		<?php if (Configure::read('debug')) { ?>
		<p><?php echo $this->Html->link(__d('queue', 'Trigger Execute Job(s)'), ['controller' => 'QueuedJobs', 'action' => 'execute']); ?></p>
		<?php } ?>
            </div>
	    </div>
    </div>
</div>

</div>


