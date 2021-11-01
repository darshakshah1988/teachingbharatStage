<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $enquiry
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Enquiry') ?>  
        </h1>
        <small><?php echo empty($enquiry->id) ? __('Here you can add New enquiry') : __('Here you can edit enquiry'); ?></small> 
</div>
<?php $this->end(); ?>

<div class="InnerAreamt">
        <div class="container mt180">
            <div class="col-md-12 Imarea">
                <div class="col-md-12 logoIconMiddle">
                    <?php echo $this->Html->image('new/TB-icon.png'); ?>
                </div>
                <div class="col-md-6 col-md-offset-3 text-center">
                    <div class="col-md-12 InnerText">
                        <h2 class="InnTitle">ASK <span>QUESTION</span></h2>
                        <p style="text-align: justify">If you have any Questions to us and you may want to know something from us, please feel free to ask us a Question.</p>
                    </div>
                    <div class="col-md-12 contactSend">
                        <?= $this->Form->create($enquiry, ['id' => 'enquiryForm','context' => ['validator' => 'enquiry'], 'url' => ['controller' => 'Enquiries', 'action' => 'add', 'plugin' => 'Enquiry'],'templates' => ['inputContainer' => '<div class="input {{type}}{{required}}"><div class="form-group">{{content}}</div></div>', 
                //'input' => '<input type="{{type}}" name="{{name}}"{{attrs}}/><span class="invalid-feedback" role="alert"></span>',
                'formGroup' => '{{label}}{{input}}{{error}}',
                ]]); 
                    echo $this->Form->hidden('enquiry_type', ['value' => 'ask-question']);
                    echo $this->Form->hidden('subject', ['value' => 'Question']);
                    ?>
                            <div class="form-group">
                                <?= $this->Form->control('full_name', ['placeholder' => 'Your Name', 'class' => 'form-control mytbox', 'div' => false, 'label' => false, 'escape' => false]); ?>
                            </div>
                            <div class="form-group">
                                <?= $this->Form->control('email', ['placeholder' => 'Your Email', 'class' => 'form-control mytbox', 'div' => false, 'label' => false, 'escape' => false]); ?>
                            </div>
                            <div class="form-group">
                                <?= $this->Form->control('mobile', ['placeholder' => 'Your Contact No.', 'class' => 'form-control mytbox', 'div' => false, 'label' => false, 'escape' => false]); ?>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control mytbox" rows="5" placeholder="Your Question"></textarea>
                            </div>
                            <button type="submit" class="btn btn-block mybtn">Send</button>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $this->Html->script(['common', 'Inquiry'], ['block' => true]); ?>    
<script type="text/javascript">
<?php $this->Html->scriptStart(['block' => true]); ?>

$formFubmit = new Inquiry();
$(document).on("submit","form#enquiryForm ", function(event){
      event.preventDefault();
      $formFubmit.submitEnquiry($(this));
});

<?php $this->Html->scriptEnd(); ?> 
</script>
<?php
$this->assign('title', $metaData['meta_title']);
$this->Html->meta(
    'keywords', $metaData['meta_keyword'], ['block' => true]
);
$this->Html->meta(
    'description', $metaData['meta_description'], ['block' => true]
);
?>