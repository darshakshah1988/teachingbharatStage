<?php
$this->layout = "ajax";
?>
<?= $this->Form->create($listing, ['role' => 'form', 'enctype' => 'multipart/form-data', 'templates' => 'ajax_form_error']) ?>
    <?php
        echo $this->Form->control('listing_type_id', ['options' => $listingTypes,'empty' => 'Select Listing Type', 'class' => 'form-control','templates' => [
                            'select' => '<div class="col-md-8"><select name="{{name}}"{{attrs}}>{{content}}</select><span class="invalid-feedback" role="alert"></span></div>',
                ]]);
        echo $this->Form->control('parent_id', ['options' => $parentListings, 'empty' => 'Parent Listing', 'class' => 'form-control']);
        echo $this->Form->control('title', ['class' => 'form-control', 'placeholder' => __('Title'), 'templates' => [
                            'input' => '<div class="col-md-8"><input type="{{type}}" name="{{name}}"{{attrs}}/><span class="invalid-feedback" role="alert"></span></div>',
                ]]); 
        echo $this->Form->control('tag_line', ['class' => 'form-control', 'placeholder' => __('Tag Line')]);?>

        <div class="row required">
            <label class="col-md-3 control-label" for="title">Domain Name</label>
            <div class="col-md-3">
                <?php echo $this->Form->control('protocol', ['options' => ['http://' => 'http://', 'https://' => 'https://'],'class' => 'form-control', 'placeholder' => __('Protocol'), 'label' => false, 'templates' => [
                            'select' => '<select name="{{name}}"{{attrs}}>{{content}}</select><span class="invalid-feedback" role="alert"></span>',
                            'inputContainer' => '<div class="form-group input {{type}}{{required}}">{{content}}</div>'
                ]]); ?>
            </div>
            <div class="col-md-5">
                <?php echo $this->Form->control('domain_name', ['class' => 'form-control', 'placeholder' => __('Domain Name'), 'label' => false, 'templates' => [
                            'input' => '<input type="{{type}}" name="{{name}}"{{attrs}}/><span class="invalid-feedback" role="alert"></span>',
                            'inputContainer' => '<div class="form-group input {{type}}{{required}}">{{content}}</div>'
                ]]); ?>
            </div>
        </div>
        <?php echo $this->Form->control('sort_order', ['class' => 'form-control','min' => 0, 'placeholder' => __('Sort Order')]);?> 

<!-- <div class="check-custom">
<?php
    //echo $this->Form->checkbox('is_visible', ['hiddenField' => false, 'id' => 'is_visible']);
?>
<label for="is_visible">Visable on home</label>
</div> -->

<?= $this->Form->end() ?>
