<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $event
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Event') ?>
        </h1>
        <small><?php echo empty($event->id) ? __('Here you can add New event') : __('Here you can edit event'); ?></small>
</div>
<?php $this->end(); ?>

<div class="row events index content">
<div class="col-12 col-sm-12 col-md-12">
        <div class="panel-default">
            <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= __(empty($event->id) ? 'Add Event' : 'Edit Event') ?></h2>
                <div class="d-flex flex-wrap">
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>

            <?= $this->Form->create($event, ['role' => 'form', 'enctype' => 'multipart/form-data', 'templates' => 'default_form']) ?>
            <div class="panel-body">
                    <div class="tab-sec">
                        <ul class="nav nav-tabs responsive">
                            <li class="nav-item"><a class="nav-link active" id="a-tab" href="#tab-a" data-toggle="tab">General</a></li>
                            <li class="nav-item"><a class="nav-link" id="b-tab" href="#tab-b" data-toggle="tab">Event Image</a></li>
                            <li class="nav-item"><a class="nav-link" id="c-tab" href="#tab-c" data-toggle="tab">Description</a></li>
                            <li class="nav-item"><a class="nav-link" href="#tab-d" data-toggle="tab">Meta Data</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab-a" aria-labelledby="a-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <?php 
                                            echo $this->Form->control('title', ['class' => 'form-control', 'placeholder' => __('Title')]);
                                            echo $this->Form->control('sub_title', ['class' => 'form-control', 'placeholder' => __('Sub Title')]);
                                            
                                            echo $this->Form->control('start_date', ['class' => 'form-control', 'placeholder' => __('Start Date')]);
                                            echo $this->Form->control('end_date', ['class' => 'form-control', 'placeholder' => __('End Date')]);
                                             echo $this->Form->control('status', ['options' => [1 => 'Active', 0 => 'In-Active'],'class' => 'form-control','empty' => false, 'placeholder' => __('Status')]);
                                            echo $this->Form->control('position', ['class' => 'form-control', 'placeholder' => __('Position')]);
                                        ?>
                                    </div>
                                    <div class="col-md-6">
                                        <?php 
                                        echo $this->Form->control('location', ['class' => 'form-control', 'placeholder' => __('Location')]);
                                        echo $this->Form->control('organizar_name', ['class' => 'form-control', 'placeholder' => __('Organizar Name')]);
                                        echo $this->Form->control('organizer_email', ['class' => 'form-control', 'placeholder' => __('Organizer Email')]);
                                        echo $this->Form->control('organizer_contact_number', ['class' => 'form-control', 'placeholder' => __('Organizer Contact Number')]);
                                        echo $this->Form->control('banner', ['type' => 'file','label' => false]);
                                        if (!empty($event->banner_path) && !is_array($event->banner) && file_exists("img/" . $event->banner_path . $event->banner)) { ?>
                                            <div class="form-group">
                                                <?php
                                                echo $this->Html->image($event->banner_path . $event->banner, ['class' => 'img-thumbnail', 'style' => 'max-height:100px']);
                                                ?>
                                            </div>
                                        <?php } ?> 
                                    </div>
                                </div>
                             <?php
                                
                               // echo $this->Form->control('banner', ['class' => 'form-control', 'placeholder' => __('Banner')]);
                               
                               
                            ?>
                            </div>
                            <div class="tab-pane fade" id="tab-b">
                               <h5 class="heading">Event Galleries</h5>

                               <div class="row">
                                    <div class="col-md-3 pull-left form-group">
                                        <div id="filecontainer">
                                            <?php echo $this->Html->link("<i class=\"fa fa-fw fa-download\"></i> " . __(' Select Images'), "javascript:;", ["class" => "btn btn-flat btn-success", "id" => "pickfiles", "escape" => false]); ?>
                                        </div>
                                    </div>
                                </div>


                            <div class="row">
                                            <div class="col-md-12" style="display:block;">
                                                <div id="faildToupload"></div>
                                            </div>
                                            <div class="col-md-12">
                                            <table class="table table-striped galleryTable" style="margin-top: 30px;">
                                                <tbody id="listingimage">
                                                    <?php
                                                    $inc = 0;
                                                    if(isset($event->event_images)){
                                                    foreach ($event->event_images as $ik => $limage) {
                                                        $idc = !empty($limage->id) ? $limage->id : $inc;
                                                        ?>
                                                        <tr id="limage_<?php echo $idc; ?>">
                                                            <td width="15%">
                                                                <?php
                                                                $_tdir = $limage->image_path . $event->id . "/"; 
                                                                if(empty($limage->id)){
                                                                      $_tdir = "tmp/";
                                                                 }
                                                               if (!empty($limage->banner) && file_exists("img/".$_tdir .$limage->banner)) {
                                                                    $photo = $_tdir .$limage->banner;
                                                                } else {
                                                                    $photo = 'no_image.gif';
                                                                }
                                                                echo $this->Html->image($photo, ['class' => '', 'alt' => 'Image', 'style' => 'max-height:80px;']);
                                                                echo $this->Form->control('event_images.' . $inc . '.banner', ['type' => 'hidden']);
                                                                echo $this->Form->control('event_images.' . $inc . '.file_type', ['type' => 'hidden', 'value' => 1]);
                                                                echo $this->Form->control('event_images.' . $inc . '.id', ['type' => 'hidden']);
                                                                ?>
                                                            </td>
                                                            <td width="45%">
                                                                <?php echo $this->Form->control('event_images.' . $inc . '.caption', ['type'=>'textarea','row'=>5,'class' => 'form-control', 'placeholder' => 'Image Caption', 'label' => false]); ?>
                                                            </td>
                                                            <td width="30%">
                                                                <?php echo $this->Form->control('event_images.' . $inc . '.position', ['class' => 'form-control', 'placeholder' => 'Sort Order', 'min' => 0,'label' => false]); ?>
                                                            </td>
                                                            <td>
                                                                <?php if(!empty($limage['id'])){ ?>
                                                                    <a href="javascript:;" onclick="deleteimage(<?php echo $limage['id']; ?>, '<?php echo $limage['image']; ?>');" class="btn btn-block btn-danger btn-xs btn-flat"><i class="fa fa-trash"></i> </a> 
                                                                  <?php }else{ ?>
                                                                    <a href="javascript:;" onclick="$('#limage_<?php echo $idc; ?>').remove();" class="btn btn-block btn-danger btn-xs btn-flat"><i class="fa fa-trash"></i> </a> 
                                                                  <?php } ?>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        $inc++;
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                                <?php if ($inc == 1) { ?>
                                                    <tr id="chooseImg">
                                                        <td colspan="4" align="center"><strong>Please Select Images and Upload</strong></td>
                                                    </tr>
                                                <?php } ?>
                                            </table>
                                            </div>
                                        </div>











                            </div>

                            <div class="tab-pane fade" id="tab-c">

                               <?php 
                                echo $this->Form->control('short_description', ['type' => 'textarea','class' => 'form-control', 'placeholder' => __('Short Description')]);
                               echo $this->Form->control('description', ['class' => 'form-control ckeditor', 'placeholder' => __('Description')]); ?>
                            </div>

                            <div class="tab-pane fade" id="tab-d">
                               <?php 
                               echo $this->Form->control('meta_title', ['class' => 'form-control', 'placeholder' => __('Meta Title')]);
                                echo $this->Form->control('meta_keyword', ['class' => 'form-control', 'placeholder' => __('Meta Keyword')]);
                                echo $this->Form->control('meta_description', ['class' => 'form-control', 'placeholder' => __('Meta Description')]);
                                ?>
                            </div>


                        </div>
                    </div>

               
                </div>





            <div class="panel-footer d-flex flex-wrap justify-content-between align-items-center">
                <?php echo $this->Form->button("<i class='fa fa-fw fa-save'></i> " . __('Submit'), ['class' => 'btn btn-primary btn-sm btn-flat my-button', 'title' => __('Submit'), 'escapeTitle' => false]); ?>
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> " . __('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Cancel'), 'escape' => false]); ?>
            </div>
            <?= $this->Form->end() ?>

        </div>
    </div>
</div>
<?php
echo $this->Html->script(['/assets/plugins/plupload/js/plupload.full.min'], ['block' => true]);
?>

<script type="text/javascript">
<?php $this->Html->scriptStart(['block' => true]); ?>
   

    var video_row = <?= 1 ?>;
    function addVideo(language_id) {
        html = '<tr id="videoBox-' + video_row + '" class="videoBox"><input type="hidden" name="event_videos[' + video_row + '][file_type]" value="2"/>';
        html += '  <td class="text-left"><input type="text" name="event_videos[' + video_row + '][banner]" value="" placeholder="Video Code" id="input-image' + video_row + '" class="form-control" /></td>';
        html += '  <td class="text-center"><textarea name="event_videos[' + video_row + '][caption]" placeholder="Caption" class="form-control"></textarea></td>';
        html += '  <td class="text-center"><div class="form-group"><input type="number" name="event_videos[' + video_row + '][position]" value="" min=0 placeholder="Sort Order" class="form-control" /></div></td>';
        html += '  <td class="text-right"><button type="button" onclick="$(\'#videoBox-' + video_row + ', .tooltip\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-block btn-danger btn-xs btn-flat"><i class="fa fa-minus-circle"></i></button></td>';
        html += '</tr>';
        $('table#bannerVideo tbody').append(html);
            video_row++;
    }
  

        
    $(document).ready(function(){
       var dataError = <?php echo json_encode($event->getErrors());?>;
        $.each( dataError, function( key, value ) {
            console.log( value );
            console.log( key + ": " + value['_empty'] );
            var data = $( "input[name='"+key+"'], textarea[name='"+key+"']" ).closest( "div.tab-pane" ).attr("id");
            console.log(key);
            console.log(data);
             $('.nav-tabs a[href="#'+data+'"]').tab('show')
             return false;
         }); 
    });    
    
 var uploader = new plupload.Uploader({
    runtimes : 'html5,flash,silverlight,html4',
    browse_button : 'pickfiles', // you can pass an id...
    container: document.getElementById('filecontainer'), // ... or DOM Element itself
    url : '<?php echo $this->Url->build(['controller' => 'Events', 'action' => 'tempcrop']); ?>',
    flash_swf_url : '<?= $this->request->getAttribute('webroot') ?>assets/plugins/plupload/js/Moxie.swf',
    silverlight_xap_url : '<?= $this->request->getAttribute('webroot') ?>assets/plugins/plupload/js/Moxie.xap',
    filters : {
        max_file_size : '10mb',
        mime_types: [
            {title : "Image files", extensions : "jpg,gif,png,jpeg"},
            {title : "Zip files", extensions : "zip"}
        ]
    },
    dragdrop: true,   
    headers: { 
        "X-CSRF-Token" : $('meta[name="csrf-token"]').attr('content'),
         Accept: "application/json",         
    },
    resize : {width : 320, height : 240, quality : 90},
    init: {
        PostInit: function() {
            document.getElementById('faildToupload').innerHTML = '';
//          document.getElementById('uploadfiles').onclick = function() {
//              uploader.start();
//              return false;
//          };
        },

        FilesAdded: function(up, files) {
            uploader.start();
            document.getElementById('faildToupload').innerHTML = '';
            plupload.each(files, function(file) {
                //document.getElementById('faildToupload').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
            });
        },
        FileUploaded: function (up, file, response) {
                var response = $.parseJSON(response.response);
                console.log(response);
                var imgHtm = '';
                var imgpath = '';
                if (response.status === true) {
                    if (response.image_path) {
                        imgpath = response.image_path;
                    }
                    imgHtm += '<tr id="limage_' + file.id + '"> ';
                    imgHtm += '<td width="15%"> <img src="'+ response.image_path +'" style="max-height:80px;"></td>';
                    imgHtm += '<td width="45%"><input class="form-control" type="hidden" name="event_images[' + file.id + '][file_type]" value="1"><input class="form-control" type="hidden" name="event_images[' + file.id + '][banner]" value="'+ response.filename +'"><textarea class="form-control" row=5 placeholder="Image Caption" name="event_images[' + file.id + '][caption]"></textarea></td>';
                    imgHtm += '<td width="15%"> <input class="form-control" type="number" name="event_images[' + file.id + '][position]" min="0" placeholder="Sort Order"></td>'
                    imgHtm += '<td width="15%"><a class="btn btn-block btn-danger btn-xs btn-flat" onclick="$(\'#limage_' + file.id + '\').remove();" href="javascript:;"><i class="fa fa-trash"></i></a></td>';
                    imgHtm += '</tr>';
                    $("tbody#listingimage").append(imgHtm);
                }else{
                    document.getElementById('faildToupload').innerHTML += '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button> '+ response.message +' </div>'
                }
                
                    $("#chooseImg").remove('');
            },

        UploadProgress: function(up, file) {
            //document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
        },

        Error: function(up, err) {
            console.log("\nError #" + err.code + ": " + err.message);
        }
    }
});
uploader.init();   
    
function deleteimage(id){
        $.ajax({
            type: "DELETE",
            url: "<?php echo $this->Url->build(['controller' => 'Events', 'action' => 'deleteImages']); ?>/"+ id,
            data: {id: id},
            dataType: "JSON",
            beforeSend: function (xhr) {
                    xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
            },
            success: function (data) {
               if (data.status == true) {
                    $("#limage_" + id).remove();
                }
                alert(data.message);
            }
        });
}    
    
<?php $this->Html->scriptEnd(); ?>
</script>