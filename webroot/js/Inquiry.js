class Inquiry {

    addMasters = (obj) => {
        var _cls = this;
          console.log(obj);
          var commonMes = new common();
          let crpConfirm =  $.confirm({
            useBootstrap: false,
            boxWidth: '50%',
            titleClass: 'titleborder',
            scrollToPreviousElement: false,
            backgroundDismiss: true,
            content: function () {
                var self = this;
                return $.ajax({
                    url: obj.url,
                    type: 'get',
                    data: obj.filters != obj.filters ? obj.filters : {},
                    dataType: 'html',
                }).done(function (response) {
                    self.setContent(response);
                    self.setTitle(obj.title);
                }).fail(function(){
                    self.setContent('Something went wrong.');
                });
            },
            onContentReady: function () {
                var self = this;
                // $('.priorProp').tooltip({
                //     container: 'body',
                //     placement: 'top',
                // });
                $('[data-toggle="popover"]').popover();
                $.fn.editable.defaults.ajaxOptions = {type: "PUT"};
                $('.updateColumn').editable({
                    ajaxOptions: {
                        dataType: 'json',
                        beforeSend: function (xhr) {
                            xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                        },
                    }
                });
                if($('.colorpicker').length > 0){
                    $(".colorpicker").minicolors({
                        theme: 'bootstrap',
                        show: function() {
                          console.log('Show event triggered!');
                        }
                    });
                }

            },
             buttons: {
                submit: {
                    text: 'Save',
                    btnClass: 'btn btn-block btn-success btn-sm',
                    action: function(){
                        var form = this.$content.find("form");
                        var title = this.$content.find("input[name='title']").val();

                        if(!title){
                            commonMes.errorAlert({message: 'The title is required field.'});
                            return false;
                        }
                        var is_saved = false;
                        $.ajax({
                            url: obj.url,
                            type: 'POST',
                            dataType: 'json',
                            async: false,
                            data: form.serialize(),
                            headers: {
                                "accept": "application/json",
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (data) {
                                if(data.status==true){
                                    is_saved = true;
                                    crpConfirm.close();
                                    $.alert({
                                        columnClass: 'medium',
                                        title: (data.title != undefined && data.title != "") ? data.title : 'Success',
                                        icon: 'fa fa-check',
                                        type: 'green',
                                        content: data.message,
                                        buttons: {
                                              Ok: function(){
                                                _cls.addMasters(obj);
                                              }
                                          }
                                    });
                                }
                                else{
                                    commonMes.errorAlert(data);
                                    return false;
                                }

                            },error: function (xhr, ajaxOptions, thrownError) {
                                var errors = JSON.parse(xhr.responseText);
                                var title =   JSON.parse(xhr.responseText).message;
                                commonMes.errorAlert({ title: title,message: commonMes.ajaxErrors(errors.errors)});
                            }

                        });
                        if(!is_saved){
                            console.log("is_saved");
                            return false;
                        }

                    }
                },
                Cancel: {
                    text: 'Close',
                    btnClass: 'btn btn-block btn-secondary btn-sm',
                }
            }
        });
      }

      addTodo = (obj) => {
        var _cls = this;
          console.log(obj);
          var commonMes = new common();
          let crpConfirm =  $.confirm({
            useBootstrap: false,
            boxWidth: '50%',
            titleClass: 'titleborder',
            scrollToPreviousElement: false,
            backgroundDismiss: true,
            content: function () {
                var self = this;
                return $.ajax({
                    url: obj.url,
                    type: 'get',
                    data: obj.filters != obj.filters ? obj.filters : {},
                    dataType: 'html',
                }).done(function (response) {
                    self.setContent(response);
                    self.setTitle(obj.title);
                }).fail(function(){
                    self.setContent('Something went wrong.');
                });
            },
            onContentReady: function () {
                var self = this;
                // $('.priorProp').tooltip({
                //     container: 'body',
                //     placement: 'top',
                // });
            },
             buttons: {
                submit: {
                    text: 'Save',
                    btnClass: 'btn btn-block btn-success btn-sm',
                    action: function(){
                        var form = this.$content.find("form");
                        var is_saved = false;
                        $.ajax({
                            url: form.attr("action"),
                            type: 'POST',
                            dataType: 'json',
                            async: false,
                            data: form.serialize(),
                            headers: {
                                "accept": "application/json",
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            beforeSend: function (xhr) {
                                xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                                form.find('.is-invalid').removeClass('is-invalid');
                            },
                            success: function (data) {
                                if(data.status==true){
                                    is_saved = true;
                                    commonMes.successReload(data);
                                }
                                else{
                                    commonMes.errorAlert(data);
                                    commonMes.validationErrors(data.errors, form);
                                    return false;
                                }

                            },error: function (xhr, ajaxOptions, thrownError) {
                                var errors = JSON.parse(xhr.responseText);
                                var title =   JSON.parse(xhr.responseText).message;
                                commonMes.errorAlert({ title: title,message: commonMes.ajaxErrors(errors.errors)});
                            }

                        });
                        if(!is_saved){
                            console.log("is_saved");
                            return false;
                        }
                    }
                },
                Cancel: {
                    text: 'Close',
                    btnClass: 'btn btn-block btn-secondary btn-sm',
                }
            }
        });
      }

      submitEnquiry = (obj) => {
        var _cls = this;
          console.log(obj);
          var commonMes = new common();
          
          $.ajax({
                url: obj.attr("action"),
                type: 'POST',
                dataType: 'json',
                async: false,
                data: obj.serialize(),
                headers: {
                    "accept": "application/json",
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                    obj.find('.is-invalid').removeClass('is-invalid');
                },
                success: function (data) {
                    if(data.status==true){
                        commonMes.success(data);
                        obj[0].reset();
                    }
                    else{
                        commonMes.errorAlert(data);
                        commonMes.validationErrors(data.errors, obj);
                        return false;
                    }

                },error: function (xhr, ajaxOptions, thrownError) {
                    var errors = JSON.parse(xhr.responseText);
                    var title =   JSON.parse(xhr.responseText).message;
                    commonMes.errorAlert({ title: title,message: commonMes.ajaxErrors(errors.errors)});
                }

            });

      }
  }
