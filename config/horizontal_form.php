<?php
//https://api.cakephp.org/3.8/class-Cake.View.Helper.FormHelper.html#%24_defaultConfig
return $myTemplates = [
            // Used for button elements in button().
        'button' => '<button{{attrs}}>{{text}}</button>',
        // Used for checkboxes in checkbox() and multiCheckbox().
        'checkbox' => '<input type="checkbox" name="{{name}}" value="{{value}}"{{attrs}}>',
        // Input group wrapper for checkboxes created via control().
        'checkboxFormGroup' => '{{label}}', 
        // Wrapper container for checkboxes.
        'checkboxWrapper' => '<div class="checkbox">{{label}}</div>',
        // Widget ordering for date/time/datetime pickers.
        'dateWidget' => '{{year}}{{month}}{{day}}{{hour}}{{minute}}{{second}}{{meridian}}',
        // Error message wrapper elements.
        'error' => '<span class="invalid-feedback"><strong>{{content}}</strong></span>',
        // Container for error items.
        'errorList' => '<ul>{{content}}</ul>',
        // Error item wrapper.
        'errorItem' => '<li>{{text}}</li>',
        // File input used by file().
        'file' => '<input type="file" name="{{name}}"{{attrs}}>',
        // Fieldset element used by allControls().
        'fieldset' => '<fieldset{{attrs}}>{{content}}</fieldset>',
        // Open tag used by create().
        'formStart' => '<form{{attrs}}>',
        // Close tag used by end().
        'formEnd' => '</form>',
        // General grouping container for control(). Defines input/label ordering.
        'formGroup' => '{{label}}<div class="col-md-8">{{input}}{{error}}</div>',
        // Wrapper content used to hide other content.
        'hiddenBlock' => '<div style="display:none;">{{content}}</div>',
        // Generic input element.
        'input' => '<input type="{{type}}" name="{{name}}"{{attrs}}/><span class="invalid-feedback" role="alert"></span>',
        // Submit input element.
        'inputSubmit' => '<input type="{{type}}"{{attrs}}/>',
        // Container element used by control().
        'inputContainer' => '<div class="form-group"><div class="row input {{type}}{{required}}">{{content}}</div></div>',
        // Container element used by control() when a field has an error.
        'inputContainerError' => '<div class="form-group"><div class="row input {{type}}{{required}} error">{{content}}</div></div>',
        // Label element when inputs are not nested inside the label.
        'label' => '<label class="col-md-3 control-label"{{attrs}}>{{text}}</label>',
        // Label element used for radio and multi-checkbox inputs.
        'nestingLabel' => '{{hidden}}<label{{attrs}}>{{input}}{{text}}</label>',
        // Legends created by allControls()
        'legend' => '<legend>{{text}}</legend>',
        // Multi-Checkbox input set title element.
        'multicheckboxTitle' => '<legend>{{text}}</legend>',
        // Multi-Checkbox wrapping container.
        'multicheckboxWrapper' => '<fieldset{{attrs}}>{{content}}</fieldset>',
        // Option element used in select pickers.
        'option' => '<option value="{{value}}"{{attrs}}>{{text}}</option>',
        // Option group element used in select pickers.
        'optgroup' => '<optgroup label="{{label}}"{{attrs}}>{{content}}</optgroup>',
        // Select element,
        'select' => '<select name="{{name}}"{{attrs}}>{{content}}</select></select><span class="invalid-feedback" role="alert"></span>',
        // Multi-select element,
        'selectMultiple' => '<select name="{{name}}[]" multiple="multiple"{{attrs}}>{{content}}</select>',
        // Radio input element,
        'radio' => '<input type="radio" name="{{name}}" value="{{value}}"{{attrs}}>',
        // Wrapping container for radio input/label,
        'radioWrapper' => '{{label}}',
        // Textarea input element,
        'textarea' => '<textarea name="{{name}}"{{attrs}}>{{value}}</textarea><span class="invalid-feedback" role="alert"></span>',
        // Container for submit buttons.
        'submitContainer' => '<div class="submit">{{content}}</div>',
        //Confirm javascript template for postLink()
        'confirmJs' => '{{confirm}}',
];
?>