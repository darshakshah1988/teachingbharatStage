<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $microSession
 */
//$session = $this->request->getSession();
//$user_id=$session->read('teacher_session_id');

?>

<?php
$this->layout = "authdefault";
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $course
 */
?>
<div class="White79">
    <div class="GreyBg">
        <div class="container">
            <div class="col-md-12 AddTest RTestMark">
                <?= $this->Flash->render() ?>
                <div class="col-md-12 ATtitle">
                    <h3><?= $this->Html->link(__('Add Micro Session Chapters'), ['action' => 'index',$microsession_id], ['class' => 'side-nav-item']) ?></h3>
                </div>
                <?= $this->Form->create($microSessionChapter, ['role' => 'form', 'enctype' => 'multipart/form-data', 'templates' => 'bootstrap_validation', 'novalidate' => true]) ?>
                <?= $this->Form->hidden('status', ['value' => 0]);  ?>
                <div class="col-md-12 ATField">


                    <div class="row nopadding">
                       <div class="col-sm-3">
                                <?= $this->Form->control('start_date', ['readonly' => true,'class' => 'MyInput startdatepicker', 'placeholder' => __('Start Date'), 'label' => 'Start Date *']) ?>
                        </div>

                         <div class="col-sm-3">
                                <?= $this->Form->control('start_time', ['class' => 'MyInput starttime', 'placeholder' => __('Start Time'), 'label' => 'Start Time *']) ?>
                        </div>
                    </div>
                    <div class="row nopadding">
                        <div class="col-sm-3">
                                <?= $this->Form->control('end_date', ['readonly' => true,'class' => 'MyInput enddatepicker', 'placeholder' => __('End Date'), 'label' => 'End Date *']) ?>
                        </div>


                        <div class="col-sm-3">
                                <?= $this->Form->control('end_time', ['class' => 'MyInput endtime', 'placeholder' => __('End Time'), 'label' => 'End Time *']) ?>
                        </div>

                    </div>



        <div class="row nopadding">

        <div class="col-md-12">
        <?php echo $this->Form->control('title', ['class' => 'form-control', 'placeholder' => __('Title'), 'label' => __('Title*')]);?>
        </div>
        <div class="col-md-12">
        <?php
        echo $this->Form->control('video_url', ['class' => 'form-control', 'placeholder' => __('Video Url')]);
        $nominate_file_path = "";
        $nominate_file_name = "";

        if (!empty($microSessionChapter->chapter_file_dir) && !empty($microSessionChapter->chapter_file) && is_file(ROOT.DS.$microSessionChapter->chapter_file_dir . $microSessionChapter->chapter_file)) {
                $nominate_file_path = $microSessionChapter->chapter_file_dir.$microSessionChapter->chapter_file;
                $nominate_file_path = str_replace(DS,'/',$nominate_file_path);
                $nominate_file_path = str_replace('webroot','',$nominate_file_path);
                $nominate_file_name = $microSessionChapter->chapter_file;
            }
            ?>
<div class="col-md-3">
  <?php          echo $this->Form->control('chapter_file', ['type' => 'file', 'class' => 'dropify', 'data-height' => 30, 'label' => 'File Upload' , 'data-default-file' => $nominate_file_path]);
?>
           </div>
           <div class="col-md-3">
               <div class="form-group">

                   <?php
                   if(!empty($nominate_file_path)){
                   ?>
                   <label class="control-label">View File</label><br />
                   <a href="<?= $nominate_file_path ?>" target="_blank" title="Download File"><i class="glyphicon glyphicon-picture" style="vertical-align: middle; font-size: 28px;"></i> <?= $nominate_file_name ?></a>
                   <?php
                   }
                   ?>
               </div>
           </div>
        </div>

                    </div>
                     <div class="col-md-12 nopadding mt50">
                        <div class="col-sm-2 col-sm-offset-3">
                            <?php echo $this->Form->input('save', ['type' => 'submit', 'class' => 'btn btn-block btn-success MyBBtn', 'title' => __('Save Draft'), 'value' => __(empty($microSessionChapter->id) ? __('CREATE') : 'Update') , 'escapeTitle' => false]); ?>
                        </div>

                        <div class="col-sm-2">
                            <?php echo $this->Html->link(__('CANCEL'), ['action' => 'index',$microsession_id], ['class' => 'btn btn-block btn-danger MyBBtn', 'title' => __('Cancel'), 'escape' => false]); ?>
                        </div>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>

<?php
$this->assign('title', __(empty($microSessionChapter->id) ? 'Add New MicroSession' : 'Edit MicroSession'));
$this->Html->meta(
    'keywords', "Teaching Bharat | Online course | online education | online video", ['block' => true]
);
$this->Html->meta(
    'description', "Teaching Bharat | Online course | online education | online video", ['block' => true]
);

?>

<?php
echo $this->Html->css(['https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css
','https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css','https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css'],['block' => true]);
echo $this->Html->script(['https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js','https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js','https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js','https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js'],['block' => true]);
 ?>

<script>
<?php $this->Html->scriptStart(['block' => true]); ?>


$('.startdatepicker').datepicker({
    format: 'dd-mm-yyyy',
    todayHighlight: true
});

$('.enddatepicker').datepicker({
    format: 'dd-mm-yyyy',
    todayHighlight: true
});

// time picker

 $('.starttime').datetimepicker({
        format: 'HH:mm'
    });
 $('.endtime').datetimepicker({
        format: 'HH:mm'
    });

<?php $this->Html->scriptEnd(); ?>
</script>
