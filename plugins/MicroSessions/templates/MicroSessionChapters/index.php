<?php
$this->layout = "authdefault";
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $courseChapters
 */
?>
<div class="White79">
    <div class="GreyBg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 TitleStripp">
                    <div class="col-sm-9">
                        <?= $this->Html->link(__('Micro Session'), ['controller' => 'micro-sessions','action' => 'index'], ['class' => 'btn mybtn btn-block float-right']) ?>
                    </div>
                    <div class="col-sm-3">
              <?= $this->Html->link(__('New Micro Session Chapter'), ['action' => 'add',$microsession_id], ['class' => 'btn mybtn btn-block float-right']) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="col-md-12 nopadding mt20">
                <?= $this->Flash->render() ?>
                    <div class="col-md-12">
                       <table class="table table-bordered ssTable">
                              <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <!--<th>Description</th>
                                    <th>Chapter Status</th>-->
                                    <th>Created</th>
                                    <th class="action-col" width="25%">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php if (!empty($microSessionChapters->toArray())):
                                    $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                                    $loop = 0;
                                    foreach ($microSessionChapters as $courseChapter): ?>
                                 <tr>
                                    <td><?= $this->Number->format($i) ?>.</td>
                                    <td><?= h($courseChapter->title) ?></td>
                                    <!--<td><?//= h($courseChapter->short_description) ?></td>
                                    <td>
                                        <?php if ($courseChapter->is_free == 1) {
                                                echo "Free";
                                            }else{
                                                echo "Paid";
                                            }
                                        ?>
                                    </td>-->

                                        <td>
                                         <?php if ($courseChapter->created) {
                                            echo $courseChapter->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                            }
                                        ?>
                                        </td>
 

                                        <td class="action-col">

                                            <input type="hidden" name="display_name" id="display_name_<?= $loop ?>" value="<?= $this->request->getSession()->read('Auth.User.name') ?>">
                                    <input type="hidden" name="meeting_number" id="meeting_number_<?= $loop ?>" value="88982625484">
                                    <input type="hidden" name="meeting_pwd" id="meeting_pwd_<?= $loop ?>" value="000752">
                                    <input type="hidden" name="meeting_email" id="meeting_email_<?= $loop ?>" value="naveenbhola@gmail.com">
                                    <input type="hidden" name="meeting_url" id="meeting_url_0" value="https://teachingbharat.com/micro-sessions/micro-session-chapters/index/4">
                                    <select id="meeting_role_<?= $loop ?>" class="sdk-select" style="display: none;">
                                        <option value=0 <?= ($this->request->getSession()->read('Auth.User.role') == 'student')?'selected':'' ?>>Attendee</option>
                                        <option value=1 <?= ($this->request->getSession()->read('Auth.User.role') == 'teacher')?'selected':'' ?>>Host</option>
                                        <option value=5>Assistant</option>
                                    </select>
                                    <select id="meeting_china_<?= $loop ?>" class="sdk-select" style="display: none;">
                                        <option value=0 selected>Global</option>
                                        <option value=1>China</option>
                                    </select>
                                    <select id="meeting_lang_<?= $loop ?>" class="sdk-select" style="display: none;">
                                        <option value="en-US" selected>English</option>
                                        <option value="de-DE">German Deutsch</option>
                                        <option value="es-ES">Spanish Español</option>
                                        <option value="fr-FR">French Français</option>
                                        <option value="jp-JP">Japanese 日本語</option>
                                        <option value="pt-PT">Portuguese Portuguese</option>
                                        <option value="ru-RU">Russian Русский</option>
                                        <option value="zh-CN">Chinese 简体中文</option>
                                        <option value="zh-TW">Chinese 繁体中文</option>
                                        <option value="ko-KO">Korean 한국어</option>
                                        <option value="vi-VN">Vietnamese Tiếng Việt</option>
                                        <option value="it-IT">Italian italiano</option>
                                    </select>
                                    <a href="javascript:void(0)" id="joinSession" class="btn btn-dss btn-block joinSession">Join Session</a>

                                        <!--<?//= $this->Html->link('View', ['action' => 'view', $courseChapter->id,$microsession_id], ['class' => 'btn btn-success']) ?>-->
                                           <?= $this->Html->link('Edit Chapter', ['action' => 'add',$microsession_id, $courseChapter->id], ['class' => 'btn btn-primary']) ?>

                                       <!--  <?= $this->Form->button("Edit Chapter", ['type' => 'button', 'class' => 'btn btn-primary', 'id' => 'addChapters','data-title' => 'Edit Chapter', 'data-url' => $this->Url->build(['action' => 'edit', $courseChapter->id,$microsession_id, '?' => ['id' => $courseChapter->id]])]) ?> -->

                                        <?= $this->Html->link("Delete", ['action' => 'delete', $courseChapter->id,$microsession_id], ['class' => 'confirmDeleteBtn btn btn-danger', 'data-url'=> $this->Url->build(['action' => 'delete', $courseChapter->id,$microsession_id]), 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Delete Chapter'),'title'=>__('Delete Chapter')]) ?> 



                                        </td> 
                                </tr>
                                <?php $i++;  $loop++; endforeach; ?>
                                <?php else: ?>
                                <tr> <td colspan='13' align='center' class="tbodyNotFound" style="text-align:center;"> <strong>Record Not Available</strong> </td> 
                                </tr>
                                <?php endif; ?>
                              </tbody>
                            </table>
                    </div>                  
                </div>
        </div>
    </div>
</div>
<?php 
echo $this->Html->css(['/assets/plugins/dropify-master/dist/css/dropify.min.css','https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css
'],['block' => true]);
echo $this->Html->script(['/assets/plugins/dropify-master/dist/js/dropify.min.js', 'https://cdn.ckeditor.com/4.14.0/basic/ckeditor.js','https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js'],['block' => true]);
echo $this->Html->script(['common', 'Courses', 'Users'], ['block' => true]); ?>
<script type="text/javascript">
<?php $this->Html->scriptStart(['block' => true]); ?>
$coursesObj = new Courses();
// $(document).on("click","#addChapters ", function(event){
//       event.preventDefault();
//       $coursesObj.addChapters($(this));
// });
$(document).on("click", "#addChapters", function(event) {
        event.preventDefault();
        console.log($(this));
       $coursesObj.addChapters({'title': $(this).data('title'),'url': $(this).data('url'), filters: {id: <?= $courseChapter->id ?>}});
});
<?php $this->Html->scriptEnd(); ?> 
</script>


<?php 
echo $this->Html->css(['master_class.css'],['block' => true]);
echo $this->Html->script(['/assets/plugins/jquery-loading-overlay-master/dist/loadingoverlay.min'],['block' => true]);
echo $this->Html->script(['common', 'Courses'], ['block' => true]); ?>
<?php $this->Html->scriptStart(['block' => true]); ?>
$coursesObj = new Courses();
$(document).on("click", ".joinFree", function(event){
    event.preventDefault();
    var _this = $(this);
    $coursesObj.joinSession({'url': _this.attr('href'), postData: {id : _this.data('id')}});
});
<?php $this->Html->scriptEnd(); ?>
</script>
<style type="text/css">
    #zmmtg-root{
        display:none;
    }
    body {
        overflow: scroll !important;
    }
</style>
<script src="https://source.zoom.us/1.8.6/lib/vendor/react.min.js"></script>
<script src="https://source.zoom.us/1.8.6/lib/vendor/react-dom.min.js"></script>
<script src="https://source.zoom.us/1.8.6/lib/vendor/redux.min.js"></script>
<script src="https://source.zoom.us/1.8.6/lib/vendor/redux-thunk.min.js"></script>
<script src="https://source.zoom.us/1.8.6/lib/vendor/lodash.min.js"></script>
<script src="https://source.zoom.us/zoom-meeting-1.8.6.min.js"></script>
<?php 
echo $this->Html->script(['/js/zoom/tool','/js/zoom/vconsole.min','/js/zoom/index']);?>
