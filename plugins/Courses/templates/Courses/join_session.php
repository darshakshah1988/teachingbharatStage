<section class="master_class_header">
    <div class="container">
         <div class="col-sm-10 col-sm-offset-1 master-detail-top-text">
         </div>
    </div>
</section>

<?php 
echo $this->Html->css(['master_class.css'],['block' => true]);
echo $this->Html->css(['https://source.zoom.us/1.8.5/css/bootstrap.css'],['block' => true]);
echo $this->Html->css(['https://source.zoom.us/1.8.5/css/react-select.css'],['block' => true]);

echo $this->Html->script(['https://source.zoom.us/1.8.5/lib/vendor/react.min.js'], ['block' => true]);
echo $this->Html->script(['https://source.zoom.us/1.8.5/lib/vendor/react-dom.min.js'], ['block' => true]);
echo $this->Html->script(['https://source.zoom.us/1.8.5/lib/vendor/redux.min.js'], ['block' => true]);
echo $this->Html->script(['https://source.zoom.us/1.8.5/lib/vendor/redux-thunk.min.js'], ['block' => true]);
echo $this->Html->script(['https://source.zoom.us/1.8.5/lib/vendor/lodash.min.js'], ['block' => true]);
echo $this->Html->script(['https://source.zoom.us/zoom-meeting-1.8.5.min.js'], ['block' => true]);

echo $this->Html->script(['/assets/zoom/js/meeting.js'], ['block' => true]);
?>

<script>
<?php $this->Html->scriptStart(['block' => true]); ?>
 const simd = async () => WebAssembly.validate(new Uint8Array([0, 97, 115, 109, 1, 0, 0, 0, 1, 4, 1, 96, 0, 0, 3, 2, 1, 0, 10, 9, 1, 7, 0, 65, 0, 253, 15, 26, 11]))
        simd().then((res) => {
          console.log("simd check", res);
        });
<?php $this->Html->scriptEnd(); ?>
</script>
