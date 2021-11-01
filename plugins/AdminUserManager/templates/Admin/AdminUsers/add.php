<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $adminUser
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Users') ?>  
        </h1>
        <small><?php echo empty($adminUser->id) ? __('Here you can add new staff user') : __('Here you can edit staff user'); ?></small> 
</div>
<?php $this->end(); ?>

<div class="row adminUsers index content">
<div class="col-12 col-sm-12 col-md-12">
        <div class="panel-default">
            <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= __(empty($adminUser->id) ? 'Add staff user' : 'Edit staff user') ?></h2>
                <div class="d-flex flex-wrap">
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>
            <?php
            $this->loadHelper('Form', [
                'templates' => 'horizontal_form',
                'errorClass' => 'is-invalid',
            ]);
            ?>
            <?= $this->Form->create($adminUser, ['role' => 'form','type' => 'file']) ?>
            <div class="panel-body">
                
                <?php 
                    echo $this->Form->control('title', ['options' => ['Mr' => 'Mr', 'Mrs' => 'Mrs', 'Miss' => 'Miss'],'class' => 'form-control', 'placeholder' => __('Title')]);
                    echo $this->Form->control('first_name', ['class' => 'form-control', 'placeholder' => __('First Name')]);
                    echo $this->Form->control('middle_name', ['class' => 'form-control', 'placeholder' => __('Middle Name')]);
                    echo $this->Form->control('last_name', ['class' => 'form-control', 'placeholder' => __('Last Name')]);
                    echo $this->Form->control('mobile', ['class' => 'form-control', 'placeholder' => __('Mobile')]);
                    echo $this->Form->control('dob', ['class' => 'form-control', 'placeholder' => __('Dob')]);
                   
                    echo $this->Form->control('email', ['class' => 'form-control', 'placeholder' => __('Email')]);
                    echo $this->Form->control('status', ['options' => [1 => 'Active', 0 => 'In-active'],'class' => 'form-control', 'empty' => __('Select')]);
                    echo $this->Form->control('roles._ids', ['options' => $roles, 'class' => 'form-control multi'.($this->Form->isFieldError('roles') ? " is-invalid" : "")]);
                    
                ?>
                <div class="form-group">
            <div class="row">
                <?php //dump($adminUser); ?>
                <div class="col-md-2 offset-md-3">
                        <?php
                        if ((!empty($adminUser->image_path) && !is_object($adminUser->profile_photo) && !empty($adminUser->profile_photo)) && file_exists("img/".$adminUser->image_path . $adminUser->profile_photo)) { 
                                    $userPhoto = $adminUser->image_path . $adminUser->profile_photo;
                                }else{
                                    if(!empty($this->request->getData('base64img'))){
                                        $userPhoto = $this->request->getData('base64img');
                                    }else{
                                        $userPhoto = "site_user.png";
                                    }
                                }
                                echo $this->Html->image($userPhoto, ['class' => 'img-thumbnail crpdimage', 'alt' => 'Image', 'width' => 200, 'height' => 200]); ?>
                </div>
                <div class="col-md-6">
                    <?php 
                    //echo $this->Form->control('profile_photo', ['type' => 'hidden']);
                    echo $this->Form->control('base64img', ['type' => 'hidden']); ?>
                    <button type="button" id="imageCroping" data-loading-text="Loading..." class="btn btn-rounded btn-outline-success <?php echo ($this->Form->isFieldError('base64img') ? ' is-invalid' : '') ?>"><i class="fa fa-upload"></i> Upload Photo</button>
                    <?php if ($this->Form->isFieldError('base64img')) { ?>
                        <span class="invalid-feedbackss" role="alert">
                            <strong><?php dump($adminUser->getError('roles')['_validCount']) ?></strong>
                        </span>
                    <?php } ?>
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
echo $this->Html->css(['/assets/plugins/cropperjs-master/docs/css/maincropper', '/assets/plugins/cropperjs-master/docs/css/cropper'],['block' => true]);
echo $this->Html->script('/assets/plugins/cropperjs-master/docs/js/cropper',['block' => true]);
 ?>
<script>
<?php $this->Html->scriptStart(['block' => true]); ?>

$('document').ready(function(){
    // $( ".datepicker" ).datepicker({
    //         changeMonth: true,
    //         changeYear: true,
    //         dateFormat: "yy-mm-dd",
    //         yearRange: "-100:+0",
    //         maxDate: new Date(),
    //     }).attr('readonly', 'readonly');

});

var crpConfirm = null;
var cropperFx = null;
$(document).on('click','#imageCroping', function(event){
    event.preventDefault();
    var _this = $(this);
    crpConfirm =  $.confirm({
            //columnClass: 'col-md-10 offset-md-1',
            useBootstrap: false,
            boxWidth: '70%',
            content: function () {
                var self = this;
                return $.ajax({
                    url: "<?php echo $this->Url->build(['action' => 'cropper']) ?>",
                    dataType: 'html',
                    method: 'get'
                }).done(function (response) {
                    self.setContent(response);
                    self.setTitle("Profile Image");
                }).fail(function(){
                    self.setContent('Something went wrong.');
                });
            },
             buttons: {
                crop: {
                    text: 'Crop',
                    isHidden: true,
                    btnClass: 'btn waves-effect waves-light btn-primary proceedBtn',
                    action: function(){
                        var imageType = this.$content.find('#uploadedImageType').val();
                        console.log($('#cropperImage').length);
                        console.log(imageType);
                        if($('#cropperImage').length > 0){
                             //console.log($('.profile_photo_name').val());
                            //result = $image.cropper('getCroppedCanvas',{width: 200, height: 200 });
                            result = cropperFx['getCroppedCanvas']({width: 200, height: 200 });
                            //console.log(result);
                            var imagebase = (result.toDataURL(imageType));
                            $(".crpdimage").attr('src', imagebase);
                            $( 'input[name=base64img]' ).val(imagebase);
                        }
                    }
                },
                Cancel: function () {
                }
            }
        });
});

<?php $this->Html->scriptEnd(); ?>
</script>