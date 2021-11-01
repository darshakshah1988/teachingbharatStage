<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $setting
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Logos/Fav icons') ?>
        </h1>
        <small><?php echo __('Here you can manage the logo and fav icons Option'); ?></small>
</div>
<?php $this->end(); ?>

<div class="row settings index content">
<div class="col-12 col-sm-12 col-md-8">
<div class="d-block">
    <div class="panel-default">
        <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
            <h2><?= __(empty($setting->id) ? 'Add Setting' : 'Edit Setting') ?></h2>
            <div class="d-flex flex-wrap">
                <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
            </div>
        </div>
            <?= $this->Form->create($setting, ['role' => 'form', 'enctype' => 'multipart/form-data', 'templates' => 'default_form']) ?>
            <div class="panel-body">
            <table class="table table-striped table-bordered" id="tab-theme-files">
                                <thead>
                                    <tr>
                                        <th >Constant/Slug</th>
                                        <th width="17%">Config Value</th>
                                        <th width="22%">#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $k = 0;
                                    if (!empty($setting)) {
                                        foreach ($setting as $k => $file) {
                                            $config_err = $file->getErrors('config_value');
                                            ?>
                                            <tr>
                                                <td width="50%">
                                                    <div class="form-group <?php echo !empty($file->getErrors('slug')) ? 'has-error' : ''; ?>">
                                                        <?php
                                                        echo $this->Form->control($k . '.slug', ['class' => 'form-control', 'readonly' => empty($file->id) ? false : true, 'label' => false]);
                                                        echo $this->Form->control($k . '.title', ['type' => 'hidden']);
                                                        echo $this->Form->control($k . '.id', ['type' => 'hidden']);
                                                        echo $this->Form->control($k . '.field_type', ['type' => 'hidden', 'value' => 'text']);
                                                        echo $this->Form->control($k . '.manager', ['type' => 'hidden', 'value' => 'logos']);
                                                        // if (!empty($config_err)) {
                                                        //     echo '<div class="form-group has-error">';
                                                        //     echo "<div class='help-block'>";
                                                        //     foreach ($config_err as $error) {
                                                        //         if (is_array($error)) {
                                                        //             foreach ($error as $err) {
                                                        //                 echo $err . "<br>";
                                                        //             }
                                                        //         } else {
                                                        //             echo $error . "<br>";
                                                        //         }
                                                        //     }
                                                        //     echo "</div></div>";
                                                        // }
                                                        ?>
                                                    </div>

                                                </td>
                                                <td width="40%" align="center">
                                                    <?php
                                                    if (!empty($file->config_value) && file_exists($_dir . $file->config_value)) {
                                                            $imagename = str_replace("img/", "", $_dir) . $file->config_value;
                                                        }elseif (!empty($file->config_value) && file_exists("img/tmp/" . $file->config_value)) {
                                                            $imagename = "tmp/" . $file->config_value;
                                                        } else {
                                                            $imagename = "no_image.gif";
                                                        }
                                                    ?>
                                                    <div class="form-group thumbimage">
                                                    <?php echo $this->Html->image($imagename, ['class' => 'img-thumbnail', 'style' => 'max-height:100px;']); ?>
                                                    </div>
                                                    <button class="btn-bs-file btn btn-success margin button-upload" data-toggle="tooltip" title="Upload File" data-loading-text="Loading..." type="button">
                                                        <i class="fas fa-cloud-upload-alt"></i>
                                                        Upload
                                                    </button>
                                                    <?php echo $this->Form->control($k . '.config_value', ['type' => 'hidden', 'class' => 'config_value img-thumbnail input-image']); ?>

                                                </td>
                                                <td class="">
                                                    <?php
                                                    if ($k > 1) {
                                                        echo $this->Html->link("<i class=\"fa fa-trash\"></i> ", ['action' => 'delete', $file->id], ['class' => 'btn btn-block btn-danger pull-right confirmDeleteBtn', 'escape' => false, 'title' => __('Delete')]);
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td>
                                                <?php
                                                echo $this->Form->control('0.slug', ['class' => 'form-control', 'value' => 'MAIN_LOGO', 'readonly' => true, 'label' => false]);
                                                echo $this->Form->control('0.title', ['type' => 'hidden', 'value' => 'Main Logo']);
                                                echo $this->Form->control('0.id', ['type' => 'hidden']);
                                                echo $this->Form->control('0.field_type', ['type' => 'hidden', 'value' => 'text']);
                                                echo $this->Form->control('0.manager', ['type' => 'hidden', 'value' => 'logos']);

                                                ?>
                                            </td>
                                            <td>
                                                <div class="form-group imageBox" id="imageBox-0">
                                                        <a href="javascript:void(0)" id="thumb-image" data-gallery="thumb-image" data-toggle="image" class="img-thumbnail pull-left" data-url=<?php echo $this->Url->build(["controller" => 'Gallery', "action" => "index", "plugin" => 'GalleryManager']); ?>>
                                                            <?php echo $this->Html->image('no_image.gif', ['style' => 'max-width:150px', 'alt' => 'No Image', 'data-placeholder' => $this->Url->image('no_image.gif')]); ?>
                                                        </a>
                                                        <?php echo $this->Form->control('0.config_value', ['type' => 'hidden', 'class' => 'config_value img-thumbnail input-image']); ?>
                                                    </div>
                                            </td>
                                            <td>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <?php
                                                echo $this->Form->control('1.slug', ['class' => 'form-control', 'value' => 'MAIN_FAVICON', 'readonly' => true, 'label' => false]);
                                                echo $this->Form->control('1.title', ['type' => 'hidden', 'value' => 'Main Fav Icon']);
                                                echo $this->Form->control('1.id', ['type' => 'hidden']);
                                                echo $this->Form->control('1.field_type', ['type' => 'hidden', 'value' => 'text']);
                                                echo $this->Form->control('1.manager', ['type' => 'hidden', 'value' => 'logos']);

                                                ?>
                                            </td>
                                            <td align="center">
                                                <div class="form-group thumbimage">
                                                    <?php echo $this->Html->image("no_image.gif", ['class' => 'img-thumbnail', 'style' => 'max-height:100px;']); ?>
                                                    </div>
                                                    <button class="btn-bs-file btn btn-success margin button-upload" data-toggle="tooltip" title="Upload File" data-loading-text="Loading..." type="button">
                                                        <i class="fas fa-cloud-upload-alt"></i>
                                                        Upload
                                                    </button>
                                                <?php echo $this->Form->control('1.config_value', ['type' => 'hidden', 'class' => 'config_value img-thumbnail input-image']); ?>
                                            </td>
                                            <td>

                                            </td>
                                        </tr>
                                        <?php $k = 2;
                                            }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td>
                                            <button type="button" class="btn btn-primary pull-right" data-toggle="tooltip" title="Add New" onclick="addMoreRow()"><i class="fa fa-plus"></i></button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>

            </div>
            <div class="panel-footer d-flex flex-wrap justify-content-between align-items-center">
                <?php echo $this->Form->button("<i class='fa fa-fw fa-save'></i> " . __('Submit'), ['class' => 'btn btn-primary btn-sm btn-flat my-button', 'title' => __('Submit'), 'escapeTitle' => false]); ?>
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> " . __('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Cancel'), 'escape' => false]); ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<div class="col-md-4">
<div class="d-block">
    <div class="panel-default emailPreference">
        <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
            <h2 class="box-title">
                <i class="fa fa-exclamation"></i> Important Rules
            </h2>
        </div><!-- /.box-header -->
        <div class="panel-body">
            <p>
            For each config settings that would be added to the system, make sure it has these constant/slug:
            </p>
            <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <small class="bg-light-yellow label-xs white-color rounded">
                    MAIN_LOGO
                </small> - Will be replaced by logo from the admin settings.
            </li>
            <li class="list-group-item">
                <small class="bg-light-yellow label-xs white-color rounded">
                    MAIN_FAVICON
                </small> - Will be replaced by favicon icon image from the admin settings.
            </li>

        </ul>



        </div><!-- ./box-body -->
    </div>
</div>
</div>

</div>

<script>
<?php $this->Html->scriptStart(['block' => true]); ?>


// $(function () {
//     var URL = window.URL || window.webkitURL;
//     var inputImage = document.getElementById('inputImage');

//     if (URL && inputImage != undefined) {
//     inputImage.onchange = function () {

//       var files = this.files;
//       var file;
//         console.log(files);
//       if (cropperFx && files && files.length) {
//         crpConfirm.buttons.crop.disable();
//         var l = Ladda.create( document.querySelector( '.spinloader' ) );
//         l.start();
//         file = files[0];
//         var a=(file.size);
//         if(a > 5000000) {
//             $.alert('Image size should be less than 5mb.');
//             l.stop();
//             return false;
//         };
//         if (/^image\/\w+/.test(file.type)) {
//           uploadedImageType = file.type;
//           uploadedImageName = file.name;
//           $("#uploadedImageType").val(file.type);
//           if (uploadedImageURL) {
//             URL.revokeObjectURL(uploadedImageURL);
//           }
//           image.src = uploadedImageURL = URL.createObjectURL(file);
//           l.stop();
//         } else {
//             $.alert('Please choose an image file.');
//             l.stop();
//           //window.alert('Please choose an image file.');
//         }
//       }
//     };
//   } else {
//     inputImage.disabled = true;
//     inputImage.parentNode.className += ' disabled';
//   }

// });

    // $(document).on('change','.inputImage', function(){
    //         var files = this.files;
    //         var file;
    //         var thumb = $(this).closest('td').find('img.img-thumbnail');
    //         var labelElm = $(this).closest('td').find('label.btn-upload');
    //         if (files && files.length) {
    //             var l = Ladda.create( thumb[0] );
    //             l.start();
    //             file = files[0];
    //             var a=(file.size);
    //             if(a > 5000000) {
    //                 $.alert('Image size should be less than 5mb.');
    //                 l.stop();
    //                 return false;
    //             };
    //             if (/^image\/\w+/.test(file.type)) {
    //             uploadedImageType = file.type;
    //             uploadedImageName = file.name;
    //             console.log(thumb);
    //             thumb.attr("src",URL.createObjectURL(file));
    //             l.stop();
    //             } else {
    //                 $.alert('Please choose an image file.');
    //                 l.stop();
    //             //window.alert('Please choose an image file.');
    //             }
    //         }
    // })

    var file_row = <?php echo ($k + 1); ?>;

    function addMoreRow() {
        var file_row = ($('table#tab-theme-files tbody tr').length + 1);
        var slug = "MAIN_LOGO";
        if(file_row != 1){
            slug = "MAIN_LOGO_" + file_row;
        }
        html = '<tr id="file-row' + file_row + '">';
        html += '  <td width="50%">';
        html += '    <input name="' + file_row + '[slug]" class="form-control" required="required" maxlength="255" id="' + file_row + '-slug" value="' + slug + '" type="text">';

        html += '  <input name="' + file_row + '[title]" id="' + file_row + '-title" value="Logo ' + file_row + '" type="hidden"><input name="' + file_row + '[field_type]" id="' + file_row + '-field-type" value="text" type="hidden"><input name="' + file_row + '[manager]" id="' + file_row + '-manager" value="logos" type="hidden">';
        html += '  </td>';
        html += '  <td align="center" width="40%">';
        html += '<div class="form-group thumbimage" id="imageBox-' + file_row + '">';
        html += ' <img src="<?php echo $this->request->getAttribute("webroot"); ?>img/no_image.gif" class="img-thumbnail" data-placeholder="<?php echo $this->Url->image('no_image.gif'); ?>" style="max-height:150px;" alt="">';
        html += '</div>';
        html += '<button class="btn-bs-file btn btn-success button-upload" data-toggle="tooltip" title="" data-loading-text="Loading..." type="button" data-original-title="Upload File"><i class="fas fa-cloud-upload-alt"></i> Upload</button>';

        // html += '<label class="btn btn-block btn-primary btn-lg mb-1 btn-upload" for="inputImage_' + file_row + '" title="Upload image file">';
        // html += '<input type="file" class="sr-only inputImage" id="inputImage_' + file_row + '" name="' + file_row + '[value]" accept="image/*">' +
        //         '<span class="docs-tooltip spinloader" data-toggle="tooltip" title="" data-original-title="Import image with Blob URLs">' +
        //             '<span class="fa fa-upload"></span> Upload</span>' +
        //         '</label>';

        // html += '<div class="custom-file">' +
        //     '<input type="file" class="custom-file-input inputImage" name="' + file_row + '[config_value]" id="customFile" accept="image/*">' +
        //     '<label class="custom-file-label" for="customFile">Choose file</label>' +
        //     '</div>';


        html += '<input name="' + file_row + '[config_value]" class="config_value input-image" id="' + file_row + '-config-value" value="" type="hidden">';

        html += '  </td>';
        html += '  <td>';
        html += '<a onclick="$(\'#file-row' + file_row + '\').remove()" data-toggle="tooltip" title="Remove" class="btn btn-block btn-danger pull-right"><i class="fa fa-trash"></i></a>';
        html += '  </td>';
        html += '</tr>';

        $('table#tab-theme-files tbody').append(html);

        file_row++;
    }


     $(document).on('click','.button-upload', function () {
        var _this = $(this);
        var inputValue = _this.closest("tr").find("input.config_value");
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
                    url: '<?php echo $this->Url->build(['controller' => 'Settings', 'action' => 'uploads']); ?>',
                    type: 'post',
                    dataType: 'json',
                    data: new FormData($('#form-upload')[0]),
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function (xhr) {
                            _this.closest("tr").find(".button-upload").button('loading');
                            xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                            
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
                            iconBox.attr('src', "<?php echo $this->Url->image('no_image.gif'); ?>");
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
