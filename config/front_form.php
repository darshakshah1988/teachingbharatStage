<?php
//https://api.cakephp.org/3.8/class-Cake.View.Helper.FormHelper.html#%24_defaultConfig
return $myTemplates = [
            // Used for button elements in button().
        'inputContainer' => '<div class="input {{type}}{{required}}"><div class="form-group">{{content}}</div></div>', 
        'input' => '<input type="{{type}}" name="{{name}}"{{attrs}}/><span class="invalid-feedback" role="alert"></span>',
        'label' => '<label{{attrs}} class="control-label">{{text}}</label>',
        'formGroup' => '{{label}}{{input}}{{error}}',
        // Used for checkboxes in checkbox() and multiCheckbox().
        'checkbox' => '<input type="checkbox" name="{{name}}" value="{{value}}"{{attrs}}>',
        // Input group wrapper for checkboxes created via control().
        'checkboxFormGroup' => '{{label}}',
        // Wrapper container for checkboxes.
        'checkboxWrapper' => '{{label}}',
        'nestingLabel' => '{{hidden}}{{input}}<label{{attrs}}>{{text}}</label> <span class="pipe"></span> ',
];
?>