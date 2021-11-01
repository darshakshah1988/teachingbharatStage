<?php
$this->layout = "authdefault";
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $microSessionChapter
 */
?>
<div class="White79">
    <div class="GreyBg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 TitleStripp">
                    <div class="col-sm-9">
                        <h2><i class="glyphicon glyphicon-list-alt"></i>
                            <?= $this->Text->truncate($microSessionChapter->title, 50,  ['ellipsis' => '...', 'exact' => false]) ?></h2>
                    </div>
                    <div class="col-sm-3">
                        <?php echo $this->Html->link(__('Back'), ['action' => 'index', $microSessionChapter->id,$microsession_id], ['class' => 'btn btn-success btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                    </div>
                </div>
            </div> 
        </div>
        <div class="container">
            <div class="col-md-12 nopadding mt20">
                    <div class="col-md-12">
                       <table class="table table-hover table-bordered">
                            <tr>
                                <th width="20%"><?= __('Course') ?></th>
                                <td><?= h($microSessionChapter->title) ?></td>
                            </tr>
                            <tr>
                                <th width="20%"><?= __('Chapter Title') ?></th>
                                <td><?= h($microSessionChapter->title) ?></td>
                            </tr>
                    
                            <tr>
                                <th width="20%"><?= __('Short Description') ?></th>
                                <td><?= h($microSessionChapter->short_description) ?></td>
                            </tr>
                           
                            <?php if(!empty($microSessionChapter->video_url)){ ?>
                            <tr>
                                <th width="20%"><?= __('Video Url') ?></th>
                                <td><?= h($microSessionChapter->video_url) ?></td>
                            </tr>
                            <?php } ?>
                            <tr>
                                <th width="20%"><?= __('Chapter File') ?></th>
                                <td><?= h($microSessionChapter->chapter_file) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Created') ?></th>
                                <td>
                                    <?php if ($microSessionChapter->created) {
                                            echo $microSessionChapter->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                            }
                                        ?>
                                    </td>
                            </tr>
                            <tr>
                                <th><?= __('Modified') ?></th>
                                <td>
                                    <?php if ($microSessionChapter->modified) {
                                            echo $microSessionChapter->modified->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                            }
                                        ?>
                                    </td>
                            </tr>
                            <tr>
                                <th><?= __('Free') ?></th>
                                <td><?= $microSessionChapter->is_free ? __('Yes') : __('No'); ?></td>
                            </tr>
                        </table>
                        <div class="text">
                            <strong><?= __('Description') ?></strong>
                            <blockquote>
                                <?= $this->Text->autoParagraph($microSessionChapter->description); ?>
                            </blockquote>
                        </div>
                    </div>
                    
                </div>
        </div>
    </div>
</div>





