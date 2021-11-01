<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $media
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Media') ?>
        </h1>
        <small><?php echo empty($media->id) ? __('Here you can add new '.strtolower($title)) : __('Here you can edit '.strtolower($title)); ?></small>
</div>
<?php $this->end(); ?>

<div class="row medias index content">
<div class="col-12 col-sm-12 col-md-12">
        <div class="panel-default">
            <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= __(empty($media->id) ? 'Add '.$title : 'Edit '.$title) ?></h2>
                <div class="d-flex flex-wrap">
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index', '?' => $this->request->getQuery()], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>
            <?= $this->Form->create($media, ['role' => 'form', 'enctype' => 'multipart/form-data', 'templates' => 'default_form']) ?>
            <div class="panel-body">
                <div class="row justify-content-center">
                        <div class="col-12 col-sm-12 col-md-6">
                        <?php
                            echo $this->Form->control('title', ['class' => 'form-control', 'placeholder' => __('Title')]);
                            echo $this->Form->control('status', ['options' => [1 => "Active", 0 => "Inactive"], 'empty' => false,'class' => 'form-control', 'placeholder' => __('Status')]);
                            echo $this->Form->control('position', ['class' => 'form-control', 'placeholder' => __('Position')]);
                        ?>
                    </div>

                <div class="col-md-12">
                    <table id="bannewrImages" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-left" style="width: 15%;">Title</th>
                                <th class="text-left" style="width: 15%;">Link</th>
                                <th class="text-left" style="width: 30%;">Description</th>
                                <th class="text-center" style="width: 20%;">Image</th>
                                <th class="text-right" style="width: 15%;">Sort Order</th>
                                <th  style="width: 5%;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $key = 0;
                            if (!empty($media->media_files)) {
                                foreach ($media->media_files as $key => $mediaImg) {
                                    ?>
                                    <tr id="imageBox-<?= $key; ?>" class="row-<?= $mediaImg->id; ?> imageBox">
                                        <td class="text-left">
                                            <?php
                                            echo $this->Form->control('media_files.' . $key . '.id', ['type' => 'hidden', 'class' => 'form-control','label' => false]);
                                            echo $this->Form->control('media_files.' . $key . '.title', ['class' => 'form-control', 'placeholder' => __('Title'),'label' => false]);
                                            echo $this->Form->control('media_files.' . $key . '.sub_title', ['class' => 'form-control', 'placeholder' => __('Sub Title'),'label' => false]);

                                            ?>
                                        </td>
                                        <td class="text-left">
                                            <?php
                                            echo $this->Form->control('media_files.' . $key . '.external_link', ['type' => 'text', 'class' => 'form-control', 'placeholder' => __('External Link'),'label' => false]);
                                            ?>
                                        </td>
                                        <td class="text-left">
                                            <?php
                                            echo $this->Form->control('media_files.' . $key . '.description', ['type' => 'textarea', 'class' => 'form-control', 'placeholder' => __('Description'),'rows'=>2,'label' => false,'templates' => [
                                                    'error' => '<div class="col-md-12 error-message text-danger">{{content}}</div>',
                                                    'textarea' => '<div class="col-md-12"><textarea name="{{name}}"{{attrs}}>{{value}}</textarea></div>',
                                                ]]);
                                            ?>
                                        </td>
                                        <td class="">
                                            <?php
                                            if($this->request->getQuery('type') != "download"){
                                                if (!empty($mediaImg->media_image_path) && !empty($mediaImg->media_image) && file_exists("img/".$mediaImg->media_image_path . $mediaImg->media_image)) {
                                                        $imagename = $mediaImg->media_image_path . $mediaImg->media_image;
                                                    } else{
                                                        $imagename = "no_image.gif";
                                                    }
                                                ?>
                                            <div class="form-group thumbimage <?php echo $mediaImg->getErrors('media_files') ? "has-error" : ""; ?>">
                                                <?php
                                                    $dimention = ['w' => '150', 'h' => '60','fit'=>'crop'];
                                                    echo $this->Glide->image($imagename, $dimention, ['class' => 'img-fluid']);
                                                    ?>
                                            </div>
                                        <?php } ?>
                                            <div class="custom-file" style="margin-bottom: 15px;">
                                                <!-- <input type="file" class="custom-file-input" id="validatedCustomFile" required> -->
                                                <?php echo $this->Form->control('media_files.' . $key . '.media_image', ['type' => 'file','label' => false, 'class' => 'input-image custom-file-input', 'id' => 'validatedCustomFile_'.$key, 'templates' => [
                                                        'inputContainer' => '{{content}}',
                                                    ]]); ?>
                                                <label class="custom-file-label" for="validatedCustomFile_<?php echo $key ?>">Choose file...</label>
                                                <!-- <div class="invalid-feedback">Example invalid custom file feedback</div> -->
                                            </div>
                                            <?php echo $this->Form->control('media_files.' . $key . '.media_image', ['type' => 'hidden', 'class' => 'config_value img-thumbnail input-image form-group']);
                                            if($mediaImg->getErrors('media_files') && !empty($mediaImg->getErrors('media_files')['image'])){
                                                foreach($mediaImg->getErrors('media_files')['image'] as $error){
                                                    echo '<div class="form-group has-error">';
                                                        echo "<div class='help-block'>";
                                                        echo $error . "<br>";
                                                        echo "</div></div>";
                                                }
                                            }
                                            
                                            if (!empty($mediaImg->media_image_path) && !empty($mediaImg->media_image) && file_exists("img/".$mediaImg->media_image_path . $mediaImg->media_image)) {
                                                $ext = pathinfo($mediaImg->media_image, PATHINFO_EXTENSION);
                                                echo "<ul class='list-unstyled'> ";
                                                    echo "<li style='border-bottom:dashed 1px #3c8dbc'>";
                                                    echo $this->Html->link("<i class='fas fa-cloud-download-alt'></i> ". $mediaImg->title."<span class='pull-right'>Download</span>", ['controller' => 'Medias', 'action' => 'FileDownload',$mediaImg->id],['escape' => false]);
                                                    echo "</li>";
                                                echo "</ul>";
                                            }
                                            ?>

                                        </td>
                                        <td class="text-right">
                                            <?= $this->Form->control('media_files.' . $key . '.position', ['class' => 'form-control', 'min' => 0, 'placeholder' => __('Sort Order'),'label' => false,'templates' => [
                                                    'error' => '<div class="col-md-12 error-message text-danger">{{content}}</div>',
                                                    'input' => '<div class="col-md-12"><input type="{{type}}" name="{{name}}"{{attrs}}/></div>',
                                                ]]); ?>
                                        </td>
                                        <td class="text-left">
                                            <?php
                                            if(!empty($mediaImg->id)){
                                                echo $this->Html->link('<i class="fa fa-trash" data-toggle="tooltip" data-placement="right" data-title="Delete Image" data-original-title="Delete Image" title=""></i>', ['controller' => 'Medias', 'action' => 'deleteImage', $mediaImg->id], ['class' => 'confirmDeleteBtn btn btn-block btn-danger btn-xs btn-flat', 'escape' => false]);
                                            }else{ ?>
                                            <button type="button" onclick="$('#imageBox-<?= $key; ?>, .tooltip').remove();" data-toggle="tooltip" title="Delete Image" class="btn btn-block btn-danger btn-xs btn-flat"><i class="fa fa-trash"></i></button>
                                            <?php }
                                            ?>
                                            <!-- <button type="button" data-url="<?php echo $this->Url->build(["controller" => 'Medias', "action" => "deleteImage", $mediaImg->id]); ?>" data-toggle="tooltip" data-title="<?= $mediaImg->title; ?>" title="Remove" class="btn btn-danger confirmDeleteBtn">
                                                <i class="fa fa-minus-circle"></i>
                                            </button> -->
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>

                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5"></td>
                                <td class="text-left">
                                    <button type="button" onclick="addImage();" data-toggle="tooltip" title="<?= __('Add Banner') ?>" class="btn btn-block btn-success btn-xs btn-flat mrg-r10">
                                        <i class="fa fa-plus-circle"></i>
                                    </button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>


                </div>
            </div>
            <div class="panel-footer d-flex flex-wrap justify-content-between align-items-center">
                <?php echo $this->Form->button("<i class='fa fa-fw fa-save'></i> " . __('Submit'), ['class' => 'btn btn-primary btn-sm btn-flat my-button', 'title' => __('Submit'), 'escapeTitle' => false]); ?>
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> " . __('Cancel'), ['action' => 'index', '?' => $this->request->getQuery()], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Cancel'), 'escape' => false]); ?>
            </div>
            <?= $this->Form->end() ?>

        </div>
    </div>
</div>

<script>
<?php $this->Html->scriptStart(['block' => true]); ?>
$(document).on("change", ".custom-file-input", function() {
  var fileName = $(this).val().split("\\").pop();
  console.log(fileName);
  $(this).closest('div.custom-file').find("label.custom-file-label").addClass("selected").html(fileName);
});
    var image_row = <?= ($key+1)?>;
    function addImage(language_id) {
    html = '<tr id="imageBox-' + image_row + '" class="imageBox">';
    html += '  <td class="text-left"><div class="form-group"><input type="text" name="media_files[' + image_row + '][title]" placeholder="Title" class="form-control" /></div><div class="form-group"><input type="text" name="media_files[' + image_row + '][sub_title]" class="form-control" placeholder="Sub Title" id="media-files-' + image_row + '-sub-title" maxlength="250"><span class="invalid-feedback" role="alert"></span></div></td>';
    html += '  <td class="text-left"><input type="text" name="media_files[' + image_row + '][external_link]" placeholder="Link" class="form-control" /></td>';
    html += '  <td class="text-left"><textarea name="media_files[' + image_row + '][description]" placeholder="Description" class="form-control"></textarea></td>';

    // html += '  <td class="text-center"><input type="file" name="media_files[' + image_row + '][image]" value="" id="input-image' + image_row + '" class="input-image" /></td>';

        // html += '  <td>';
        // html += '<div class="thumbimage" id="imageBox-' + image_row + '">';
        // html += ' <img src="<?php echo $this->request->getAttribute("webroot"); ?>img/no_image.gif" class="img-thumbnail" data-placeholder="<?php echo $this->Url->image('no_image.gif'); ?>" style="max-height:150px;" alt="">';
        // html += '</div>';
        // html += '<button class="btn bg-olive btn-flat margin button-upload" data-toggle="tooltip" title="" data-loading-text="Loading..." type="button" data-original-title="Upload File"><i class="fa fa-upload"></i>Upload</button>';
        // html += '<input name="media_files[' + image_row + '][image]" class="input-image" id="' + image_row + '-config-value" value="" type="hidden">';

        // html += '  </td>';

        html += '<td>';
        html += '<div class="custom-file">' +
                    '<input type="file" class="custom-file-input" name="media_files[' + image_row + '][media_image]" id="validatedCustomFile" required>' +
                    '<label class="custom-file-label" for="validatedCustomFile">Choose file...</label>' +
                    '<div class="invalid-feedback">Example invalid custom file feedback</div>' +
                '</div>';
        html += "</td>";

    html += '  <td class="text-right"><input type="text" name="media_files[' + image_row + '][position]" value="" placeholder="Sort Order" class="form-control" /></td>';

    html += '  <td class="text-left"><button type="button" onclick="$(\'#imageBox-' + image_row + ', .tooltip\').remove();" data-toggle="tooltip" title="Delete Image" class="btn btn-block btn-danger btn-xs btn-flat"><i class="fa fa-trash"></i></button></td>';
    html += '</tr>';
    $('table#bannewrImages tbody').append(html);
    image_row++;
    }

    $(document).on('click','.button-upload', function () {
        var _this = $(this);
        var inputValue = _this.closest("tr").find("input.input-image");
        var iconBox = _this.closest("tr").find("img");
        $('#form-upload').remove();
        var fields = '<input type="file" name="file" />';
        $('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;">' + fields + '</form>');
        $('#form-upload input[name=\'file\']').trigger('click');
        if (typeof timer != 'undefined') {
            clearInterval(timer);
        }
        timer = setInterval(function () {
            if ($('#form-upload input[name=\'file\']').val() != '') {
                clearInterval(timer);
                $.ajax({
                    url: '<?php echo $this->Url->build(['controller' => 'Medias', 'action' => 'uploads']); ?>',
                    type: 'post',
                    dataType: 'json',
                    data: new FormData($('#form-upload')[0]),
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function (xhr) {
                            _this.closest("tr").find(".button-upload").button('loading');
                            xhr.setRequestHeader('X-CSRF-Token', '<?php  echo $this->request->getParam('_csrfToken'); ?>');
                    },
                    complete: function () {
                        _this.closest("tr").find(".button-upload").button('reset');
                    },
                    success: function (json) {
                        if (json.success === true) {
                            inputValue.val(json.filename);
                            iconBox.attr('src', json.image_path);
                        } else {
                            inputValue.val('');
                            iconBox.attr('src', "<?php echo $this->request->getAttribute("webroot"); ?>img/no_image.gif");
                            wowMsg(json.message);
                        }

                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            }
        }, 500);
    });


<?php $this->Html->scriptEnd(); ?>
</script>
