class FormSubmit_notuse {

    prompt = (obj) => {
        var clsObj = this;
        var alert = new Alerts();

        let crpConfirm =  $.confirm({
            useBootstrap: false,
            boxWidth: '50%',
            titleClass: 'titleborder',
            scrollToPreviousElement: false,
            scrollToPreviousElementAnimate: false,
            content: function () {
                var self = this;
                return $.ajax({
                    url: obj.url,
                    data: obj.filters,
                    dataType: 'html',
                    method: 'get'
                }).done(function (response) {
                    self.setContent(response);
                    self.setTitle("Prompt");
                }).fail(function(){
                    self.setContent('Something went wrong.');
                });
            },
            onContentReady: function () {
                var self = this;
                $( ".datepicker" ).datepicker({
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: "yy-mm-dd",
                }).attr('readonly', 'readonly');
                if(obj.filters.commitment_fee_prompt != undefined && obj.filters.commitment_fee_prompt == true){
                    this.buttons.commitmentFee.show();
                }
            },
            onClose: function(){
                //_this.tooltip('destroy');
                setTimeout(function(){ $('[data-toggle="tooltip"]').tooltip({'trigger' : 'manual'}); }, 500);
            },
             buttons: {
                commitmentFee: {
                    text: '<i class="fas fa-pound-sign"></i> Generate commitment fee invoice ('+ obj.filters.commitment_fee +')',
                    btnClass: 'btn btn-block btn-success btn-sm',
                    isHidden: true,
                    action: function(){
                        var self = this;
                        status = true;
                        clsObj.commitmentInvoice(obj, self);
                        return false;
                    }
                },
                savePrompt: {
                    text: 'Save Prompt',
                    btnClass: 'btn btn-block btn-success btn-sm',
                    action: function(){
                        var self = this;
                        //console.log(this.$content.find('#opportunityStatusForm').serialize());
                        var form = $("form#leadPrompts");
                        var method = form.attr('method');
                        if(form.find("input[name='_method']").length > 0){
                            method = form.find("input[name='_method']").val();
                        }
                        var is_saved = false;
                        $.ajax({
                            url: form.attr('action'),
                            type: method,
                            data: form.serialize(),
                            dataType: 'json',
                            async: false,
                            headers: {
                                "accept": "application/json",
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            beforeSend: function() {
                                $(".is-invalid").removeClass("is-invalid");
                            },
                            success: function (data) {
                              if(data.status==true){
                                    let url = new URL(location);
                                    url.searchParams.delete('prompt');
                                    //url.searchParams.delete('opportunity_id');
                                    //window.location = url;
                                    window.history.pushState({ path: url.href }, '', url.href);

                                    var urlParams = new URLSearchParams(window.location.search);
                                    if(!urlParams.has('commitment_fee_prompt')){
                                        alert.successReload(data);
                                    }else{
                                        self.buttons.savePrompt.hide();
                                        $.alert(data.message);
                                        return false;
                                    }
                                    is_saved = true;
                              }
                              else{
                                    alert.errorAlert(data);
                                    return false;
                              }

                            },error: function (xhr, ajaxOptions, thrownError) {
                                var errors = JSON.parse(xhr.responseText);
                                var title =   JSON.parse(xhr.responseText).message;
                               // MANTRA.alert.error({ title: title,message: MANTRA.error.ajaxerror(errors.errors)});
                               formErrorsflash(errors.errors, "leadPrompts");
                            }

                        });
                        if(!is_saved){
                            console.log("is_saved");
                            return false;
                        }

                    }
                },

                Cancel: {
                    text: 'Cancel',
                    btnClass: 'btn btn-block btn-secondary btn-sm',
                }
            }
        });
    }

    commitmentInvoice = (obj, button) => {
        var alert = new Alerts();
        var self = button != undefined ? button : null;
        $.ajax({
            async: false,
            url: obj.filters.commitment_url,
            type: 'post',
            data: obj.filters,
            dataType: 'json',
            headers: {
                "accept": "application/json",
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if(response.status == true){
                    $.alert({
                        columnClass: 'medium',
                        title: 'Success',
                        icon: 'fa fa-check',
                        type: 'green',
                        content: response.message,
                        buttons: {
                            Ok: function(){
                                let url = new URL(location);
                                url.searchParams.delete('commitment_fee_prompt');
                                //url.searchParams.delete('opportunity_id');
                                //window.location = url;
                                console.log(url.href);
                                window.history.pushState({ path: url.href }, '', url.href);

                                var urlParams = new URLSearchParams(window.location.search);
                                if(!urlParams.has('prompt')){
                                        location.reload();
                                }else{
                                    if(self){
                                        self.buttons.commitmentFee.hide();
                                    }
                                    return false;
                                }
                            }
                        }
                    });
                }else{
                    $.alert({
                    columnClass: 'medium',
                    title: 'Error',
                    icon:  'fa fa-warning',
                    type:  'red',
                    content: response.message,
                    });
                }
            },error: function (xhr, ajaxOptions, thrownError) {
                var errors = JSON.parse(xhr.responseText);
                var title =   JSON.parse(xhr.responseText).message;
                $.alert({
                    columnClass: 'medium',
                    title: 'Error',
                    icon:  'fa fa-warning',
                    type:  'red',
                    content: '<ul>' + printErrorMsg(errors.errors) + '</ul>',
                    });
            }
        });

    }

    commitmentFee = (obj) => {
        var clsObj = this;
        $.confirm({
            useBootstrap: false,
            boxWidth: '60%',
            titleClass: 'titleborder',
            scrollToPreviousElement: false,
            scrollToPreviousElementAnimate: false,
            content: function () {
                    var self = this;
                    return $.ajax({
                        url: obj.url,
                        dataType: 'html',
                        method: 'get'
                    }).done(function (response) {
                        self.setContent(response);
                        self.setTitle("Commitment fee invoice");
                    }).fail(function(){
                        self.setContent('Something went wrong.');
                    });
                },
            onContentReady: function () {
                var self = this;
                if(self.$content.find('input').length == 0){
                    this.buttons.ok.hide();
                }
            },
             buttons: {
                ok: {
                    text: '<i class="fas fa-pound-sign"></i> Generate Invoice',
                    btnClass: 'btn btn-block btn-success btn-sm',
                    action: function(){
                        clsObj.commitmentInvoice(obj);
                        return false;
                    }
                },

                close: {
                    text: 'Cancel',
                    btnClass: 'btn btn-block bg-default btn-sm',
                    action: function(){
                    }
                },
            }
        });

    }


    enquiryForm = (obj) => {
        $.ajax({
            async: false,
            url: obj.attr('action'),
            type: 'post',
            data: obj.filters,
            dataType: 'json',
            headers: {
                "accept": "application/json",
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if(response.status == true){
                    
                }else{
                    
                }
            },error: function (xhr, ajaxOptions, thrownError) {
                var errors = JSON.parse(xhr.responseText);
                var title =   JSON.parse(xhr.responseText).message;
                $.alert({
                    columnClass: 'medium',
                    title: 'Error',
                    icon:  'fa fa-warning',
                    type:  'red',
                    content: '<ul>' + printErrorMsg(errors.errors) + '</ul>',
                    });
            }
        });
    }

}
