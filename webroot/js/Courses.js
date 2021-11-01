class Courses {

    addChapters = (obj) => {
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
                CKEDITOR.replace( 'ckeditor01' );
                $('.dropify').dropify();

            },
             buttons: {
                submit: {
                    text: 'Save',
                    btnClass: 'btn btn-success btn-sm',
                    action: function(){
                        var form = this.$content.find("form");
                        // var title = this.$content.find("input[name='title']").val();

                        // if(!title){
                        //     commonMes.errorAlert({message: 'The title is required field.'});
                        //     return false;
                        // }
                        var is_saved = false;
                        var description = CKEDITOR.instances['ckeditor01'].getData();


                        var formObj = form[0]; // You need to use standard javascript object here
                        var formData = new FormData(formObj);
                        formData.set('description', description);
                       
                        $.ajax({
                            url: obj.url,
                            type: 'POST',
                            data: formData,
                            contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                            processData: false,
                            dataType: 'json',
                            async: false,
                            //data: form.serialize(),
                            headers: {
                                "accept": "application/json",
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            beforeSend: function() {
                                $(".is-invalid").removeClass("is-invalid");
                            },
                            success: function (data) {
                                if(data.status==true){
                                    is_saved = true;
                                    commonMes.successReload(data);
                                }
                                else{
                                    //commonMes.errorAlert(data);
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
                    btnClass: 'btn btn-danger btn-sm',
                }
            }
        });
      }
 
      getCourses = (obj) => {
            $.ajax({
                url: obj.url,
                type: 'GET',
                data: obj.postData,
                dataType: 'HTML',
                //data: form.serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    $("#loaderContaner").LoadingOverlay("show");
                },
                success: function (response) {
                    $("#loaderContaner").html(response);
                },complete: function() {
                        $("#loaderContaner").LoadingOverlay("hide");
                },error: function (xhr, ajaxOptions, thrownError) {
                        $("#loaderContaner").LoadingOverlay("hide");
                    var errors = JSON.parse(xhr.responseText);
                    var title =   JSON.parse(xhr.responseText).message;
                    alert(title);
                }

            });
      }

       joinSession = (obj) => {
        var commonMes = new common();
            $.ajax({
                url: obj.url,
                type: 'POST',
                data: obj.postData,
                dataType: 'json',
                headers: {
                    "accept": "application/json",
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    //$(".is-invalid").removeClass("is-invalid");
                },
                success: function (data) {
                    if(data.status==true){
                        $.alert({
                            columnClass: 'medium',
                            title: (data.title != undefined && data.title != "") ? data.title : 'Success',
                            icon: 'fa fa-check',
                            type: 'green',
                            content: '<h4>Your Free seat for the Master Class is confirmed.</h4><p>We have sent you the joining link of class on your Email and SMS. Please join the class on time.</p>',
                            buttons: {
                                  Ok: function(){
                                    if (typeof getSessions == 'function') { 
                                          getSessions(); 
                                        }else{
                                            location.reload();
                                        }
                                      
                                  }
                              }
                        });
                        
                        //$(".joinSession").remove();
                    }
                    else{
                        //commonMes.errorAlert(data);
                        commonMes.errorAlert(data);
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
