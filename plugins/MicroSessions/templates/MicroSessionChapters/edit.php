 <?= $this->Form->create($microSessionChapter, ['role' => 'form', 'enctype' => 'multipart/form-data', 'templates' => 'default_form']) ?>
<div class="panel-body" style="padding-top: 100px!important;">
    <?php     
        echo $this->Form->control('title', ['class' => 'form-control', 'placeholder' => __('Title')]);
        echo $this->Form->control('video_url', ['class' => 'form-control', 'placeholder' => __('Video Url')]);
        $nominate_file_path = "";
        if (!empty($microSessionChapter->chapter_file_path) && !empty($microSessionChapter->chapter_file) && file_exists("img/".$microSessionChapter->chapter_file_path . $microSessionChapter->chapter_file)) {
                $nominate_file_path = WWW_ROOT .'img/'. $microSessionChapter->chapter_file_path."/".$microSessionChapter->chapter_file;
            }
      // //  echo $this->Form->control('chapter_file', ['type' => 'file', 'class' => 'dropify', 'data-height' => 30, 'label' => 'File Upload' , 'data-default-file' => $nominate_file_path]);

      //   echo $this->Form->control('short_description', ['type' => 'textarea','class' => 'form-control', 'placeholder' => __('Short Description')]);
      //   echo $this->Form->control('description', ['class' => 'form-control', 'placeholder' => __('Description'), 'id' => 'ckeditor01']);
      //   //echo $this->Form->control('position', ['class' => 'form-control', 'placeholder' => __('Position')]);

      //   echo $this->Form->control('position', ['options' => [1 => "Left", 0 => "Right"], 'empty' => false, 'class' => 'MyInput', 'label' => __('Position')]); 
       
       // echo $this->Form->control('is_free', ['class' => 'form-control', 'placeholder' => __('Is Free')]);
    ?>
    
    <!--<div class="col-md-12 nopadding mt50">
                        <div class="col-sm-2 col-sm-offset-3">
                            <?php// echo $this->Form->input('save', ['type' => 'submit', 'class' => 'btn btn-block btn-success MyBBtn', 'title' => __('Save Draft'), 'value' => __(empty($microSessionChapter->id) ? __('CREATE') : 'Update') , 'escapeTitle' => false]); ?>
                        </div>
                        
                        <div class="col-sm-2">
                            <?php// echo $this->Html->link(__('CANCEL'), ['action' => 'index',$microsession_id], ['class' => 'btn btn-block btn-danger MyBBtn', 'title' => __('Cancel'), 'escape' => false]); ?>
                        </div>
                    </div>--->

    

                   
</div>
<?= $this->Form->end() ?>