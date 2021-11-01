(function($) {
    "use strict";

    var EDU = {};

    /* -------------------------- Declare Variables ------------------------- */
    var $document = $(document);
    var $window = $(window);
    var $html = $('html');
    var $body = $('body');


   
/* -------------------------- This object used for jquery confirm alert box popups ------------------------- */
    EDU.alert = {
        success: function(data) {
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
        },
        successReload: function(data) {
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
        },
        error: function(data) {
            $.alert({
                columnClass: 'medium',
                title: (data.title != undefined && data.title != "") ? data.title : 'Error',
                icon:  'fa fa-warning',
                type:  'red',
                content: data.message,
             });
        },
    }


    /* -------------------------- This object used for datepicker ------------------------- */
    EDU.datepicker = {
        readonly: function(){
            $( ".datepicker" ).datepicker({
                dateFormat: "yy-mm-dd",
            }).attr('readonly', 'readonly');
        },
        dropdownReadonly: function(){
            $( ".datepicker" ).datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: "yy-mm-dd",
            }).attr('readonly', 'readonly');
        },
        datepicker: function(){
            $( ".datepicker" ).datepicker({
                dateFormat: "yy-mm-dd",
            });
        }
    }


    /* -------------------------- This object used for errors looping ------------------------- */
    EDU.error = {
        ajaxerror: function(errors) {
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
        },
    }

    /* -------------------------- This object used change opportunity status ------------------------- */
    EDU.listing = {
        init: function() {
            var t = setTimeout(function() {
                if($('.listings .quickAdd').length > 0){
                    $(document).on('click','.quickAdd', function(event){
                        event.preventDefault();
                        EDU.listing.quickAdd($(this));
                    });
                }
            }, 0);
        },
        quickAdd: function(obj){
                    event.preventDefault();
                    var _this = $(this);
                    let crpConfirm =  $.confirm({
                        //columnClass: 'col-md-10 offset-md-1',
                        useBootstrap: false,
                        boxWidth: '50%',
                        titleClass: 'titleborder',
                        content: function () {
                            var self = this;
                            return $.ajax({
                                url: obj.attr('href'),
                                dataType: 'html',
                                method: 'get'
                            }).done(function (response) {
                                self.setContent(response);
                                self.setTitle("Opportunity Status");
                            }).fail(function(){
                                self.setContent('Something went wrong.');
                            });
                        },
                        onContentReady: function () {
                            var self = this;
                            // EDU.datepicker.dropdownReadonly();
                            // EDU.drawn.init();
                        },
                        onClose: function(){
                            //_this.tooltip('destroy');
                            setTimeout(function(){ $('[data-toggle="tooltip"]').tooltip({'trigger' : 'manual'}); }, 500);
                        },
                         buttons: {
                            save: {
                                text: "<i class='fa fa-fw fa-save'></i> Save",
                                btnClass: 'btn btn-block btn-success btn-sm',
                                action: function(){

                                    let form = this.$content.find("form");
                                    //console.log(this.$content.find('#opportunityStatusForm').serialize());
                                    console.log(form.attr('action'));
                                    var is_saved = false;
                                    $.ajax({
                                        url: form.attr('action'),
                                        type: 'post',
                                        dataType: 'json',
                                        async: false,
                                        data: form.serialize(),
                                        headers: {
                                            "accept": "application/json",
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        success: function (data) {
                                          if(data.status==true){
                                                EDU.alert.successReload(data);
                                                is_saved = true;
                                          }
                                          else{
                                            let obj = new common();
                                            obj.validationErrors(data.errors, form);
                                                EDU.alert.error(data);
                                                return false;
                                          }

                                        },error: function (xhr, ajaxOptions, thrownError) {
                                            var errors = JSON.parse(xhr.responseText);
                                            var title =   JSON.parse(xhr.responseText).message;
                                            EDU.alert.error({ title: title,message: EDU.error.ajaxerror(errors.errors)});
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
    }


    /* -------------------------- This object used for defaut methods ------------------------- */
    EDU.onReady = {
        init: function() {
            var t = setTimeout(function() {
                EDU.onReady.priceformat();
            }, 0);
        },
        priceformat: function(){
            if($('.priceFormat').length > 0){
                $('.priceFormat').priceFormat({
                    prefix: '£',
                    centsLimit:2,
                    centsSeparator:'.',
                    thousandsSeparator:',',
                    clearPrefix: true
                });
            }
        }
    }

    /* ---------- document ready, window load, scroll and resize ------------ */
    //document ready
    EDU.documentOnReady = {
        init: function() {
            EDU.listing.init();
        }
    };

    /* ---------------------------- Call Functions -------------------------- */
    $document.ready(
        EDU.documentOnReady.init
    );

})(jQuery);
