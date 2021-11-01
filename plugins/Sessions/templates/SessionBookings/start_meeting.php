<?php
$this->layout = "blank";
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $sessionBookings
 */
?>

<link type="text/css" rel="stylesheet" href="https://source.zoom.us/1.8.6/css/bootstrap.css" />
<link type="text/css" rel="stylesheet" href="https://source.zoom.us/1.8.6/css/react-select.css" />
<link type="text/css" rel="stylesheet" href="https://teachingbharat.com/teaching_theme/css/zoom-custom.css" />
<style> 
.ax-outline-blue {
	
	display:none !important;
}
div #phone{
	display:none !important;
}
.full-screen-icon{
     visibility:hidden;
}
</style>

    <script src="https://source.zoom.us/1.8.6/lib/vendor/react.min.js"></script>
    <script src="https://source.zoom.us/1.8.6/lib/vendor/react-dom.min.js"></script>
    <script src="https://source.zoom.us/1.8.6/lib/vendor/redux.min.js"></script>
    <script src="https://source.zoom.us/1.8.6/lib/vendor/redux-thunk.min.js"></script>
    <script src="https://source.zoom.us/1.8.6/lib/vendor/lodash.min.js"></script>
    <script src="https://source.zoom.us/zoom-meeting-1.8.6.min.js"></script>
<?php 
echo $this->Html->script(['/js/zoom/tool','/js/zoom/meeting']);?>
<script>
<?php $this->Html->scriptStart(['block' => true]); ?>

        const simd = async () => WebAssembly.validate(new Uint8Array([0, 97, 115, 109, 1, 0, 0, 0, 1, 4, 1, 96, 0, 0, 3, 2, 1, 0, 10, 9, 1, 7, 0, 65, 0, 253, 15, 26, 11]))
        simd().then((res) => {
          console.log("simd check", res);
        });
    
<?php $this->Html->scriptEnd(); ?>
</script>