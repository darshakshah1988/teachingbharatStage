<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $module
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Module') ?>  
        </h1>
        <small><?php echo __('Here you can view module Detail'); ?></small>
</div>
<?php $this->end(); ?>
<div class="row modules view content">
<div class="col-12 col-sm-12 col-md-12">
    <div class="panel-default">
        <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= h($module->title) ?></h2>
                <div class="d-flex flex-wrap">
                    <?= $this->Html->link("<i class=\"fa fa-edit\"></i> " . __('Edit Module'), ['action' => 'add', $module->id], ['class' => 'btn btn-block btn-success btn-sm btn-flat mrg-r20', 'escape' => false]) ?>
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>
            <div class="panel-body">
<table class="table table-hover table-bordered">
               
                <tr>
                    <th width="20%"><?= __('Title') ?></th>
                    <td><?= h($module->title) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Plugin') ?></th>
                    <td><?= h($module->plugin) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Controller') ?></th>
                    <td><?= h($module->controller) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Action') ?></th>
                    <td><?= h($module->action) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Full Url') ?></th>
                    <td>
                        <?php
                            $json_url = json_decode($module->json_path, true);
                            $json_url['prefix'] = false;
                            if(\Cake\Routing\Router::routeExists($json_url)){
                                echo $this->Url->build($json_url, ['fullBase' => true]);
                            }else{
                                echo $module->json_path;
                                echo "<br><strong>Error:</strong> This Route could not be found.";
                            }
                            ?>
                                
                    </td>
                </tr>
                
                <tr>
                    <th width="20%"><?= __('Meta Title') ?></th>
                    <td><?= h($module->meta_title) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Meta Keyword') ?></th>
                    <td><?= h($module->meta_keyword) ?></td>
                </tr>
                <tr>
                    <th><?= __('Meta Description') ?></th>
                    <td>
                        <?= $this->Text->autoParagraph(h($module->meta_description)); ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td>
                        <?php if ($module->created) {
                                echo $module->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td>
                        <?php if ($module->modified) {
                                echo $module->modified->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                
            </table>

        </div>
    </div>
</div>



