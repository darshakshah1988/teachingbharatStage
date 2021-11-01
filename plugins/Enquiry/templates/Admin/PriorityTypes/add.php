<?php
$this->layout = "ajax";
?>
<div class="row priorityTypes index content">
    <div class="col-12 col-sm-12 col-md-12 form-group">
            <?= $this->Form->create($priorityType, ['role' => 'form', 'enctype' => 'multipart/form-data', 'templates' => 'horizontal_form']) ?>
                <?php
                    echo $this->Form->control('title', ['class' => 'form-control', 'placeholder' => __('Title')]);
                    echo $this->Form->control('position', ['class' => 'form-control', 'placeholder' => __('Sort Order')]);
                ?>
            <?= $this->Form->end() ?>
    </div>
    <?php
    if(!$priorityTypeList->isEmpty()){ ?>
    <div class="col-12 col-sm-12 col-md-12 form-group">
    <div class="table-responsive">
    <!-- <button type="button" class="btn btn-lg btn-danger" data-toggle="popover" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?">Click to toggle popover</button> -->
            <table class="table table-bordered">
                <tr>
                    <th>#</th>
                    <th width="40%">Title</th>
                    <th width="40%">Priority Order</th>
                    <th>Created</th>
                    <th>Action</th>
                </tr>
                <?php foreach($priorityTypeList as $k => $priority){ ?>
                <tr class="row-<?php echo $priority->id ?>">
                    <td><?php echo ($k + 1) ?></td>
                    <td><a href="#" class="updateColumn" data-name="title" data-type="text" data-pk="<?php echo $priority->id ?>" data-url="<?php echo $this->Url->build(['controller' => 'PriorityTypes', 'action' => 'edit', $priority->id]); ?>" data-title="Update Title"><?php echo $priority->title ?></a></td>
                    <td><a href="#" class="updateColumn" data-name="position" data-type="text" data-pk="<?php echo $priority->id ?>" data-url="<?php echo $this->Url->build(['controller' => 'PriorityTypes', 'action' => 'edit', $priority->id]); ?>" data-title="Update Position"><?php echo $priority->position; ?></a>
                    </td>
                    <td>
                        <?php if ($priority->created) {
                                echo $priority->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                            }
                        ?>
                    </td>
                    <td>
                    <?= $this->Html->link("<i class=\"fa fa-trash\"></i>", ['action' => 'delete', $priority->id], ['class' => 'confirmDeleteBtn btn btn-block btn-danger btn-xs btn-flat removeRaw', 'data-url'=> $this->Url->build(['action' => 'delete', $priority->id]), 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Delete priority'),'title'=>__('Delete priority')]) ?>
                    </td>
                </tr>
                <?php } ?>
            </table>
    </div>
    </div>
    <?php } ?>
</div>
<script>
    $(document).ready(function() {

    });
</script>
