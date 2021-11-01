<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $enquiries
 */
use Cake\Core\Configure;

$large = ['w' => '1250', 'h' => '450','fit'=>'crop'];

$imagename = $metaData['image_path'] . $metaData['banner'];
$bannerImgSize = ['w' => '1700', 'h' => '742','fit'=>'crop'];
$backImg = "uploads/banners/banne-733.jpg";
 if (!empty($metaData['image_path']) && !empty($metaData['banner']) && file_exists("img/".$metaData['image_path'] . $metaData['banner'])) {
   $backImg = $metaData['image_path'] . $metaData['banner'];
}
?>  

<div class="InnerArea">
  <img src="<?php echo $this->Glide->url($backImg, $bannerImgSize); ?>" width="100%" />
        <div class="container">
            <div class="col-md-12 Imarea">
                <div class="col-md-12 logoIconMiddle">
                    <?php echo $this->Html->image("LogoIcon.png"); ?>
                </div>
                <div class="col-md-7 InnerText">
                    <h2 class="InnTitle">CONTACT <span>US</span></h2>
                    <p style="text-align: justify"><?= nl2br(\Cake\Core\Configure::read('Setting.CONTACT_TEXT')) ?></p>
                    <h3 style="font-size: 20px">ADDRESS :</h3>
                    <p><?= nl2br(\Cake\Core\Configure::read('Setting.OFFICE_ADDRESS')) ?></p>
                    <br>
                    <h4>CALL US: <?= \Cake\Core\Configure::read('Setting.TELEPHONE') ?></h4>
                    <h4>MAIL US: <?= \Cake\Core\Configure::read('Setting.ADMIN_EMAIL') ?></h4>
                </div>
                <div class="col-md-5 contactSend">
                    <h2>For any Query, Please send Message to us.</h2>
                    <?= $this->Form->create($contactEnquiry, ['id' => 'enquiryForm','context' => ['validator' => 'enquiry'], 'url' => ['controller' => 'Enquiries', 'action' => 'add', 'plugin' => 'Enquiry'],'templates' => ['inputContainer' => '<div class="input {{type}}{{required}}"><div class="form-group">{{content}}</div></div>', 
                //'input' => '<input type="{{type}}" name="{{name}}"{{attrs}}/><span class="invalid-feedback" role="alert"></span>',
                'formGroup' => '{{label}}{{input}}{{error}}',
                ]]); ?>
                        <div class="form-group">
                        <?= $this->Form->control('subject', ['placeholder' => 'Subject', 'class' => 'form-control', 'div' => false, 'label' => false, 'escape' => false]); ?>
                    </div> 

                    <div class="form-group">
                        <?= $this->Form->control('full_name', ['placeholder' => 'Your Name', 'class' => 'form-control', 'div' => false, 'label' => false, 'escape' => false]); ?>
                    </div> 
                    
                    <div class="form-group">
                        <?= $this->Form->control('email', ['placeholder' => 'Your Email', 'class' => 'form-control', 'div' => false, 'label' => false, 'escape' => false]); ?>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->control('mobile', ['placeholder' => 'Your Contact No.', 'class' => 'form-control', 'div' => false, 'label' => false, 'escape' => false]); ?>
                    </div>  
                    <div class="form-group">
                        <?= $this->Form->control('message', ['placeholder' => 'Your Message', 'type' => 'textarea', 'class' => 'form-control', 'div' => false, 'label' => false]); ?>
                    </div>      
                    
                    <div class="form-group">
                            <?= $this->Form->submit('Send', ['class' => 'btn btn-block mybtn', 'escape' => false]); ?>
                     </div>
                    <?= $this->Form->end(); ?>
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