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
            <?= __('Manage Setting') ?>
        </h1>
        <small><?php echo empty($setting->id) ? __('Here you can add New setting') : __('Here you can edit setting'); ?></small>
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
            <?= $this->Form->create($setting, ['role' => 'form', 'enctype' => 'multipart/form-data','templates' => 'default_form']) ?>
            <div class="panel-body">
                <?php
                    echo $this->Form->control('title', ['class' => 'form-control', 'placeholder' => __('Title')]);
                    echo $this->Form->control('slug', ['class' => 'form-control', 'placeholder' => __('Constant/Slug'),'templates' => ['input' => '<input type="{{type}}" name="{{name}}"{{attrs}}/> <p class="help-block">No space, separate each word with underscore. (if you want auto generated then please leave blank)</p>',]]);
                    echo $this->Form->control('field_type', ['options'=> ['text'=>'Text','checkbox'=>'Yes/No'], 'class' => 'form-control', 'placeholder' => __('Field Type')]);
                    echo $this->Form->control('config_value', ['class' => 'form-control', 'placeholder' => __('Config Value')]);
                    ?>
                        <label class="switch small field_type_switch">
		                  <?php echo $this->Form->checkbox('setting_hidden'); ?>
                          <span class="range-slider"></span>
                        </label>
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
                    SITE_TITLE
                </small> - Will be replaced by website title from the admin settings.
            </li>
            <li class="list-group-item">
                <small class="bg-light-yellow label-xs white-color rounded">
                    ADMIN_EMAIL
                </small> - Will be replaced by admin email from the admin settings.
            </li>
            <li class="list-group-item">
                <small class="bg-light-yellow label-xs white-color rounded">
                    FROM_EMAIL
                </small> - Will be replaced by email from the admin settings.
            </li>
            <li class="list-group-item">
                <small class="bg-light-yellow label-xs white-color rounded">
                    WEBSITE_OWNER
                </small> - Will be replaced by Owner name from admin settings.
            </li>
            <li class="list-group-item">
                <small class="bg-light-yellow label-xs white-color rounded">
                    TELEPHONE
                </small> - Will be replaced by phone number from admin settings.
            </li>
            <li class="list-group-item">
                <small class="bg-light-yellow label-xs white-color rounded">
                    ADMIN_PAGE_LIMIT
                </small> - Will be replaced by admin page limit from admin settings.
            </li>
            <li class="list-group-item">
                <small class="bg-light-yellow label-xs white-color rounded">
                    FRONT_PAGE_LIMIT
                </small> - Will be replaced by front page limit from admin settings.
            </li>
            <li class="list-group-item">
                <small class="bg-light-yellow label-xs white-color rounded">
                    ADMIN_DATE_FORMAT
                </small> - Will be replaced by admin date format from admin settings.
            </li>
            <li class="list-group-item">
                <small class="bg-light-yellow label-xs white-color rounded">
                    ADMIN_DATE_TIME_FORMAT
                </small> - Will be replaced by admin date time format from admin settings.
            </li>
            <li class="list-group-item">
                <small class="bg-light-yellow label-xs white-color rounded">
                    FRONT_DATE_FORMAT
                </small> - Will be replaced by front date format from admin settings.
            </li>
            <li class="list-group-item">
                <small class="bg-light-yellow label-xs white-color rounded">
                    FRONT_DATE_TIME_FORMAT
                </small> - Will be replaced by front date time format from admin settings.
            </li>
            <li class="list-group-item">
                <small class="bg-light-yellow label-xs white-color rounded">
                    CONTACT_US_TEXT
                </small> - Will be replaced by front date time format from admin settings.
            </li>
            <li class="list-group-item">
                <small class="bg-light-yellow label-xs white-color rounded">
                    GOOGLE_MAP_KEY
                </small> - Will be replaced by front date time format from admin settings.
            </li>
            <li class="list-group-item">
                <small class="bg-light-yellow label-xs white-color rounded">
                    OFFICE_ADDRESS
                </small> - Will be replaced by front date time format from admin settings.
            </li>

            <li class="list-group-item">
                <small class="bg-light-yellow label-xs white-color rounded">
                    DEVELOPMENT_MODE
                </small> - Will be replaced by debug mode from admin settings.
            </li>

        </ul>



        </div><!-- ./box-body -->
    </div>
</div>
</div>

</div>
<script>
<?php $this->Html->scriptStart(['block' => true]); ?>
    fieldType();
    $(function () {
       $("select[name='field_type']").on("change",function(){
           fieldType();
       });
    });
    function fieldType(){
        var _type = $("select[name='field_type']").val();
        var elm = $("div textarea");
        console.log(elm);
        if(_type=="checkbox"){
            $(".field_type_switch").show();
            elm.hide();
            $(".field_type_switch").find("input").attr('name', 'config_value');
            elm.find("textarea").attr('name', 'setting_hidden');
            elm.find("textarea").attr('required', false);
        }else{
            $(".field_type_switch").hide();
            elm.show();
            $(".field_type_switch").find("input").attr('name', 'setting_hidden');
            elm.find("textarea").attr('name', 'config_value');
        }
    }
<?php $this->Html->scriptEnd(); ?>
</script>
