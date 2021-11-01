<?php
//$this->layout = "authdefault";
/**
 * Copyright 2010 - 2019, Cake Development Corporation (https://www.cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010 - 2018, Cake Development Corporation (https://www.cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<div class="SLoginArea">
        <div class="container">
            <div class="col-md-12">
                <div class="col-md-8 col-md-offset-2 FTStep">
                    <div class="col-md-10 col-md-offset-1 nopadding">
                        <div class="col-md-12">
                            <div class="col-md-2">
                                <?= $this->Html->image('RudraaAssistant.gif') ?> 
                            </div>
                            <div class="col-md-10">
                                <h2>How often do you want to Learn.</h2>
                            </div>
                        </div>
                        <div class="col-md-12 select centeralign learnList">
                            <div class="col-md-12">
                                <?php 

                                //$learnlist = [1 => 'JUST THIS ONCE', 'A FEW TIMES', 'REGULARLY', 'NOT SURE'];

                                foreach($teacherSchedules as $lid => $learn){ ?>
                                    <a href="javascript:void(0)" data-board="<?= $lid ?>" class="tag2<?php echo $this->request->getQuery('teacher_schedules') && in_array($lid, $this->request->getQuery('teacher_schedules')) ? " active" : "" ?>"><?= $learn ?></a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 bottom">
                        <?= $this->Form->create(null, ['url' => ['controller' => 'Users', 'action' => 'teachers', 'plugin' => 'UserManager'], 'role' => 'form', 'enctype' => 'multipart/form-data', 'type' => 'get','valueSources' => ['query', 'context'], 'id' => 'assistantForm']) ?>
                        <div class="" style="display: none ;">
                        <?php
                                //echo $this->Form->input("step", ['type' => 'hidden', 'value' => 'learn']);
                                echo $this->Form->select('teacher_schedules', $teacherSchedules, ['multiple' => 'checkbox']);
                                echo $this->Form->select('subjects', $subjects, ['multiple' => 'checkbox']);
                                echo $this->Form->select('grading_types', $gradingTypes, ['multiple' => 'checkbox']);
                                echo $this->Form->select('boards', $boards, ['multiple' => 'checkbox']);
                            //$this->Form->input("board.", ['type' => 'hidden']);
                            //$this->Form->input("grade.", ['type' => 'hidden']) 

                                 $queryStr = $this->request->getQuery();
                                $queryStr['step'] = 'subject';
                                ?>
                        </div>
                        <div class="col-md-4 leftalign">
                            <?= $this->Html->link("<i class=\"glyphicon glyphicon-menu-left\"></i> Back", ['controller' => 'Users', 'action' => 'assistant', 'plugin' => 'UserManager', '?' => $queryStr], ['class' => 'backbtn', 'escape' => false]) ?>
                        </div>
                        <div class="col-md-4 centeralign">
                            <a class="nobtn">Step : 3 / 3</a>
                        </div>
                        <div class="col-md-4 rightalign">
                            <?= $this->Form->button("Next <i class=\"glyphicon glyphicon-menu-right\"></i>", ['class' => 'btn btn-success', 'escapeTitle' => false]) ?>
                        </div>
                        <?= $this->Form->end() ?>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>

<?php
$this->assign('title', "How often do you want to Learn");
$this->Html->meta(
    'keywords', 'How often do you want to Learn', ['block' => true]
);
$this->Html->meta(
    'description', 'How often do you want to Learn', ['block' => true]
);

//$this->Html->css(['/assets/plugins/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.min'], ['block' => true]);
//$this->Html->script(['/assets/plugins/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.min'], ['block' => true])//;
?> 


<style type="text/css">
a.active {
    background: #ed4426 !important;
    border: 1px solid #de5900 !important;
    text-decoration: none !important;
    color: #fff !important;
    transition: 0.4s;
}
</style>
 <script>
<?php $this->Html->scriptStart(['block' => true]); ?>

     $("#assistantForm").on("submit", function(){
        var is_board = true;
        var is_grad = true;
        if($(".learnList a.active").length == 0){
            is_board = false;
                $.alert({
                    title: '',
                    content: 'Please choose at least one option.',
                });
            return false;
        }
    });

    $("div.learnList a").on("click", function(){
        var _this = $(this);
        _this.toggleClass('active');
        //_this.addClass('active');
        var learns = [];
        $(".learnList a.active").each(function(index, value){
            learns.push($(this).data('board'));
        });
        $( "input[name^='teacher_schedules']" ).val(learns);
        console.log(learns);
    })
<?php $this->Html->scriptEnd(); ?>
</script>