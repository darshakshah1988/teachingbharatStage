class Alerts_notused {
    validationErrors = (errors, form) => {
        if(form.length == 0){
            return false;
        }
        this.getError(errors, form); 
    }
    getError = (errors, form) => {
        let _self = this;
        $.each(errors, function(key, value) {
            if (typeof value == 'object') {
                var element = form.find("input[name='"+key+"'], textarea[name='"+key+"'], select[name='"+key+"']" );
                if(element.attr('type') == "radio"){
                    element.closest("div").addClass('is-invalid');
                }else{
                    element.addClass('is-invalid');
                }
                var error = '';
                $.each(value, function(keyer, err) {
                        error += err;
                });

                element.closest(".form-group").find("span.invalid-feedback").html(error);
                //_self.getError(value, form);
            }else{
                var element = form.find("input[name='"+key+"'], textarea[name='"+key+"'], select[name='"+key+"']" );
                console.log(element);
            }
        })
    }
    successReload = (data) => {
        $.alert({
            columnClass: 'medium',
            title: (data.title != undefined && data.title != "") ? data.title : 'Success',
            icon: 'fa fa-check',
            type: 'green',
            content: data.message,
            buttons: {
                  Ok: function(){
                      location.reload();
                  }
              }
        });
    }
    errorAlert = (data) => {
        $.alert({
            columnClass: 'medium',
            title: (data.title != undefined && data.title != "") ? data.title : 'Error',
            icon:  'fa fa-warning',
            type:  'red',
            content: data.message,
         });
    }
    success = (data) => {
        $.alert({
            columnClass: 'medium',
            title: (data.title != undefined && data.title != "") ? data.title : 'Success',
            icon: 'fa fa-check',
            type: 'green',
            content: data.message,
            buttons: {
                  Ok: function(){
                  }
              }
        });
    }
    ajaxErrors = (errors) => {
        var alertErrs = '';
        console.log(errors);
        if(errors != undefined){
            $.each(errors, function(index, value) {
                if(value[0] != undefined){
                    alertErrs += value[0];
                }
            });
        }
        return alertErrs;
    }
    formErrorsflash = (errors, formId) => {
        var html = '';
    $.each(errors, function(key, value) {
        if (typeof value == 'object') {
            $.each(value, function(key2, value2) {
                var element = $("#"+ formId + " input[name='"+key+"'], #"+formId+" textarea[name='"+key+"'], #"+formId+" select[name='"+key+"']" );
                if(element.length == 0){
                    var id = key.replace('.', '_').replace('.', '_');
                    element = $("#"+ id);
                }
                if(element.attr('type') == "radio"){
                    element.closest("div").addClass('is-invalid');
                }else{
                    element.addClass('is-invalid');
                }
                var erText = value2.replace('.', ' ');
                element.closest(".form-group").find("span.invalid-feedback").html(erText);
            });
        } else {
            var element = $("#"+ formId + " input[name='"+key+"'], # "+formId+" textarea[name='"+key+"']" );
            if(element.attr('type') == "radio"){
                element.closest("div").addClass('is-invalid');
            }else{
                element.addClass('is-invalid');
            }
            var erText = value.replace('.', '_');
            element.closest(".form-group").find("span.invalid-feedback").html(value);
        }
    });
    }

}
