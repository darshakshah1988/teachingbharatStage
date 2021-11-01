<?php
$this->layout = "authdefault";
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $courseChapter
 */
?>
<div class="White79">
    <div class="GreyBg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 TitleStripp">
                    <div class="col-sm-9">
                        <h2><i class="glyphicon glyphicon-list-alt"></i>
                            <?= $this->Text->truncate($courseChapter->course->title, 50,  ['ellipsis' => '...', 'exact' => false]) ?></h2>
                    </div>
                    <div class="col-sm-3">
                        <?php echo $this->Html->link(__('Back'), ['action' => 'index', $courseChapter->course_id], ['class' => 'btn btn-success btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
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
                                <td><?= h($courseChapter->course->title) ?></td>
                            </tr>
                            <tr>
                                <th width="20%"><?= __('Chapter Title') ?></th>
                                <td><?= h($courseChapter->title) ?></td>
                            </tr>
                    
                            <tr>
                                <th width="20%"><?= __('Short Description') ?></th>
                                <td><?= h($courseChapter->short_description) ?></td>
                            </tr>
                           
                            <?php if(!empty($courseChapter->video_url)){ ?>
                            <tr>
                                <th width="20%"><?= __('Video Url') ?></th>
                                <td><?= h($courseChapter->video_url) ?></td>
                            </tr>
                            <?php } ?>
                            <tr>
                                <th width="20%"><?= __('Chapter File') ?></th>
                                <td><?= h($courseChapter->chapter_file) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Created') ?></th>
                                <td>
                                    <?php if ($courseChapter->created) {
                                            echo $courseChapter->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                            }
                                        ?>
                                    </td>
                            </tr>
                            <tr>
                                <th><?= __('Modified') ?></th>
                                <td>
                                    <?php if ($courseChapter->modified) {
                                            echo $courseChapter->modified->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                            }
                                        ?>
                                    </td>
                            </tr>
                            <tr>
                                <th><?= __('Free') ?></th>
                                <td><?= $courseChapter->is_free ? __('Yes') : __('No'); ?></td>
                            </tr>
                        </table>
                        <div class="text">
                            <strong><?= __('Description') ?></strong>
                            <blockquote>
                                <?= $this->Text->autoParagraph($courseChapter->description); ?>
                            </blockquote>
                        </div>
                    </div>
                    
                </div>
        </div>
    </div>
</div>





