<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $navigation
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Navigation') ?>
        </h1>
        <small><?php echo empty($navigation->id) ? __('Here you can add New navigation') : __('Here you can edit navigation'); ?></small>
</div>
<?php $this->end(); ?>

<div class="row navigations index content">
<div class="col-12 col-sm-12 col-md-8">
        <div class="panel-default">
            <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= __(empty($navigation->id) ? 'Add Navigation' : 'Edit Navigation') ?></h2>
                <div class="d-flex flex-wrap">
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>
            <?= $this->Form->create($navigation, ['role' => 'form', 'enctype' => 'multipart/form-data' , 'templates' => 'horizontal_form']) ?>
            <div class="panel-body">
                <?php
                    // echo $this->Form->control('title', ['class' => 'form-control', 'placeholder' => __('Title')]);
                    // echo $this->Form->control('parent_id', ['class' => 'form-control', 'placeholder' => __('Parent Id')]);
                    // echo $this->Form->control('menu_link', ['class' => 'form-control', 'placeholder' => __('Menu Link')]);
                    // echo $this->Form->control('is_nav_type', ['class' => 'form-control', 'placeholder' => __('Is Nav Type')]);
                    // echo $this->Form->control('target', ['class' => 'form-control', 'placeholder' => __('Target')]);
                    // echo $this->Form->control('lft', ['class' => 'form-control', 'placeholder' => __('Lft')]);
                    // echo $this->Form->control('rght', ['class' => 'form-control', 'placeholder' => __('Rght')]);
                    // echo $this->Form->control('status', ['class' => 'form-control', 'placeholder' => __('Status')]);
                    // echo $this->Form->control('is_top', ['class' => 'form-control', 'placeholder' => __('Is Top')]);
                    // echo $this->Form->control('is_bottom', ['class' => 'form-control', 'placeholder' => __('Is Bottom')]);
                    // echo $this->Form->control('position', ['class' => 'form-control', 'placeholder' => __('Position')]);
                ?>

                 <div class="row">
                        <div class="col-md-12">
                            <?php
                            echo $this->Form->control('title', ['class' => 'form-control','required' => false, 'placeholder' => __('Title')]); 
                            echo $this->Form->control('parent_id', ['options' => $parentNavigations, 'class' => 'form-control', 'empty' => '[ Parent Menu ]']);
                            echo $this->Form->control('is_nav_type', ['type' => 'radio', 'default'=>1,'options' => ['1' => 'CMS Pages', '2' => 'Custom Menu', '3' => 'Modules'], 'hiddenField' => false, 'label' => 'Type', 'templates' => [
                                    'label' => '<label class="col-md-3 control-label"{{attrs}}>{{text}}</label>',
                                    'radioWrapper' => '<div class="radio menu-type">{{label}}</div>',
                                    'inputContainer' => '<div class="form-group input {{required}}"><div class="row">{{content}}</div></div>'
                            ]]);
                            ?>
                            <div id="cms_pages">
                                <?php echo $this->Form->control('page_id', ['options' => $pages, 'default' => isset($navigation->menu_link) &&  $navigation->is_nav_type == 1 ? $navigation->menu_link : '', 'class' => 'form-control menu_type','empty' => 'Select Page', 'label' => 'CMS Pages']); ?>
                            </div>
                            <div id="modules">
                                <?php echo $this->Form->control('module_id', ['options' => $modules, 'default' => isset($navigation->menu_link) &&  $navigation->is_nav_type == 3 ? $navigation->menu_link : '', 'class' => 'form-control menu_type','empty' => 'Select Module',  'label' => 'Modules']); ?>
                            </div>
                            <div id="custom_link">
                                <?php echo $this->Form->control('menu_link', ['class' => 'form-control menu_link', 'placeholder' => __('Menu Link')]); ?>
                            </div>
                            <?php
                            //echo $this->Form->control('position', ['class' => 'form-control', 'placeholder' => __('Position')]);
                            ?>
                            <?php
                            echo $this->Form->control('status', ['options' => [1 => "Active", 0 => "Inactive"], 'class' => 'form-control']);
                            ?>
                        </div>

                        <div class="col-md-6 offset-md-3">
                            <div class="form-group">
                                <div class="check-custom">
                                        <?php
                                            echo $this->Form->checkbox('is_top', ['id' => 'is_top']);
                                        ?>
                                        <label for="is_top">For Top</label>
                                    </div>
                            </div><!-- /.form-group -->
                            <div class="form-group">
                                <div class="check-custom <?php echo $navigation->getError('is_bottom') ? "is-invalid" : ""  ?>">
                                        <?php
                                            echo $this->Form->checkbox('is_bottom', ['id' => 'is_bottom']);
                                        ?>
                                        <label for="is_bottom">For Bottom</label>
                                    </div>
                                    <?php
                                    if(isset($navigation->getError('is_bottom')['manuRule'])){
                                        echo '<span class="invalid-feedback"><strong>'.$navigation->getError('is_bottom')['manuRule'] . '</strong></span>';
                                    }
                                     ?>
                            </div><!-- /.form-group -->



                        </div>

                    </div><!-- /.row -->






            </div>
            <div class="panel-footer d-flex flex-wrap justify-content-between align-items-center">
                <?php echo $this->Form->button("<i class='fa fa-fw fa-save'></i> " . __('Submit'), ['class' => 'btn btn-primary btn-sm btn-flat my-button', 'title' => __('Submit'), 'escapeTitle' => false]); ?>
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> " . __('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Cancel'), 'escape' => false]); ?>
            </div>
            <?= $this->Form->end() ?>

        </div>
    </div>

<div class="col-md-4">
    <div class="panel-default">
        <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
            <h2 class="">
                <i class="fa fa-exclamation"></i> Important Rules
            </h2>

        </div><!-- /.box-header -->
        <div class="panel-body">
            <p>For each navigation that would be added by this section, please follow these rules:</p>
            <ul >
                <li>
                    Use <small class="label bg-yellow">CMS Pages</small>
                    for list those added from cms page manager.
                </li>
                <li>
                    Use <small class="label bg-yellow">Custom Menu</small>
                    for external links or any downloadable file link.
                </li>
                <li>
                    Use <small class="label bg-yellow">Modules</small>
                    for other static pages those added by Module manager.
                </li>
            </ul>
        </div>
    </div>
</div>


</div>

<script>
<?php $this->Html->scriptStart(['block' => true]); ?>
    $(document).ready(function () {
        //on load

//         $('input').iCheck({
//            checkboxClass: 'icheckbox_square-blue',
//            radioClass: 'iradio_square-blue',
//            increaseArea: '20%' // optional
//          });
        option = $(".menu-type input[type=radio]:checked").val();
        show_menu_type(option);
        $(".menu-type input[type=radio]").change(function () {
            var option = $(this).val();
            $(".menu_link").val('');
            show_menu_type(option);
        });

        function show_menu_type(option)
        {
            $("#modules").hide();
            $("#cms_pages").hide();
            $("#custom_link").hide();

            if (option == 1)
                $("#cms_pages").show();
            else if (option == 2) {
                $("#custom_link").show();
            } else if (option == 3)
                $("#modules").show();
        }

        $(".menu_type").on('change', function () {
            $(".menu_link").val($(this).val());
        })
    });
<?php $this->Html->scriptEnd(); ?>
</script>
