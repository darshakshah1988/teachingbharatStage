 <?= $this->Form->create($courseChapter, ['role' => 'form', 'enctype' => 'multipart/form-data', 'templates' => 'default_form']) ?>
<div class="panel-body">
    <?php
        echo $this->Form->control('title', ['class' => 'form-control', 'placeholder' => __('Title')]);
        echo $this->Form->control('video_url', ['class' => 'form-control', 'placeholder' => __('Video Url')]);
        $nominate_file_path = "";
        if (!empty($courseChapter->chapter_file_path) && !empty($courseChapter->chapter_file) && file_exists("img/".$courseChapter->chapter_file_path . $courseChapter->chapter_file)) {
                $nominate_file_path = WWW_ROOT .'img/'. $courseChapter->chapter_file_path."/".$courseChapter->chapter_file;
            }
        echo $this->Form->control('chapter_file', ['type' => 'file', 'class' => 'dropify', 'data-height' => 30, 'label' => 'File Upload' , 'data-default-file' => $nominate_file_path]);

        echo $this->Form->control('short_description', ['type' => 'textarea','class' => 'form-control', 'placeholder' => __('Short Description')]);
        echo $this->Form->control('description', ['class' => 'form-control', 'placeholder' => __('Description'), 'id' => 'ckeditor01']);
        echo $this->Form->control('position', ['class' => 'form-control', 'placeholder' => __('Position')]);
       // echo $this->Form->control('is_free', ['class' => 'form-control', 'placeholder' => __('Is Free')]);
    ?>
    <?= $this->Form->checkbox('is_free', [ 'class' => 'D-checkbox', 'id' => 'is_free']); ?><label for="is_free" class="D-label">Free Chapter</label>
</div>
<?= $this->Form->end() ?>