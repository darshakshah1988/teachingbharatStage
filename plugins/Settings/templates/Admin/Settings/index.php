<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $settings
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
        <small><?php echo __('Here you can manage the settings'); ?></small>
</div>
<?php $this->end(); ?>
<div class="row settings index content">

<div class="col-12 col-sm-12 col-md-8">
<div class="d-block">
    <div class="panel-default">
        <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
            <h2><?= __('Setting') ?> List</h2>
            <div class="d-flex flex-wrap">
                <?= $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('New Setting'), ["action" => "add"], ["class" => "btn btn-block btn-primary btn-sm btn-flat", "escape" => false]) ?>
            </div>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th><?= $this->Paginator->sort('title') ?></th>
                        <th><?= $this->Paginator->sort('slug', 'Constant') ?></th>
                        <th>Value</th>
                        <th class="action-col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($settings->toArray())):
                        $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                        foreach ($settings as $setting): ?>
                        <tr>
                            <td><?= $this->Number->format($i) ?>.</td>
                            <td><?= h($setting->title) ?></td>
                            <td><?= h($setting->slug) ?></td>
                            <td>
                                <?php
                                if ($setting->field_type == "checkbox") {
                                    if ($setting->config_value == 1) {
                                        echo '<small class="bg-success label-xs white-color rounded">
                                        Enable
                                    </small>';
                                    }else{
                                        echo '<small class="bg-red label-xs white-color rounded">Disable</small>';
                                    }
                                } else {
                                    echo h($setting->config_value);
                                }
                                ?>
                            </td>
                            <td class="action-col">
								<?php 
								$url = "https://zoom.us/oauth/authorize?response_type=code&client_id=".CLIENT_ID."&redirect_uri=".REDIRECT_URI;
									if($setting->slug=='zoom_auth_token') {
										?>
										<a href="<?php echo $url ?>" class="btn btn-block btn-primary btn-sm btn-flat">Generate Token</a>
										<?php
									} else {
								?>
                                <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['action' => 'add', $setting->id], ['class' => 'btn btn-block btn-success btn-xs btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit setting'),'title'=>__('Edit setting')]) ?>
                                <?php
                                if($this->request->getAttribute('identity')->can('delete', $setting)){
                                    echo $this->Html->link('<i class="fa fa-trash" data-toggle="tooltip" data-placement="right" data-title="Delete Setting" data-original-title="Edit" title=""></i>', ['action' => 'delete', $setting->id], ['class' => 'confirmDeleteBtn btn btn-block btn-danger btn-xs btn-flat', 'escape' => false]);
                                }
									}
                                ?>
                            </td>
                        </tr>
                    <?php $i++; endforeach; ?>
                <?php else: ?>
                <tr> <td colspan='8' align='center' class="tbodyNotFound" style="text-align:center;"> <strong>Record Not Available</strong> </td> </tr>
                <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="pagination-sec d-flex justify-content-between flex-wrap align-items-center">
                <?php echo $this->element('pagination'); ?>
            </div>
        </div>
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
