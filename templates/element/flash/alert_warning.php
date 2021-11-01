<?php
/**
 * @var \App\View\AppView $this
 * @var array $params
 * @var string $message
 */
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<!-- <div class="alert alert-success" role="alert" onclick="this.classList.add('hidden')"><?= $message ?></div> -->
<?php $this->Html->scriptStart(['block' => true]); ?>
	$.alert({
	    title: 'Error',
	    icon: 'fa fa-warning',
	    type: 'orange',
	    content: '<?= $message ?>',
});
<?php $this->Html->scriptEnd(); ?>