class Users {

    teacherApprove = (obj) => { 
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
            },
             buttons: {
                submit: {
                    text: 'Save',
                    btnClass: 'btn btn-block btn-success btn-sm', 
                    action: function(){
                        var form = this.$content.find("form");
                        var title = this.$content.find("select[name='active']").val();

                        if(!title){
                            commonMes.errorAlert({message: 'The teacher status is required field.'});
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
                                    commonMes.successReload(data);
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

      changeMobile = (obj) => {
        var _userCls = this;
        var commonMes = new common();
        let crpConfirm =  $.confirm({
            useBootstrap: false,
            boxWidth: '40%',
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
                    self.setTitle('');
                }).fail(function(){
                    self.setContent('Something went wrong.');
                });
            },
            onContentReady: function () {
                var self = this;
            },
             buttons: {
                submit: {
                    text: 'Update',
                    btnClass: 'btn btn-success',
                    action: function(){
                        var form = this.$content.find("form");
                        var mobile = this.$content.find("input[name='mobile']").val();

                        if(!mobile){
                            commonMes.errorAlert({message: 'The mobile number is required field.'});
                            return false;
                        }
                        var is_saved = false;
                        $.ajax({
                            url: form.attr('action'),
                            type: 'POST',
                            dataType: 'json',
                            async: false,
                            data: form.serialize(),
                            headers: {
                                "accept": "application/json",
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (data) {
                                console.log(data.data.id);
                                if(data.status==true){
                                    is_saved = true;
                                    //commonMes.successReload(data);
                                    if(data.is_changed){
                                        crpConfirm.close();
                                         _userCls.smcOtp({'title': 'OTP - Verification','profile_id': data.data.id,'url': data.data.otpUrl, filters: {profile_id: data.data.id}});
                                     }
                                     
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
                    btnClass: 'btn btn-danger',
                }
            }
        });
      }

      smcOtp = (obj) => {
        var _this = $(this);
        var commonMes = new common();
        let crpConfirm =  $.confirm({
              useBootstrap: false,
              boxWidth: '40%',
              scrollToPreviousElement: false,
              backgroundDismiss: false,
              titleClass: 'titleborder',
              content: function () {
                  var self = this;
                  return $.ajax({
                      url: obj.url,
                      type: 'get',
                      data: obj.filters,
                      dataType: 'html',
                  }).done(function (response) {
                     self.setContent(response);
                      self.setTitle('');
                      //self.setTitle(obj.title);
                  }).fail(function(){
                      self.setContent('Something went wrong.');
                  });
              },
              onContentReady: function () {
                  var self = this;

                  this.$content.find('.digit-group input').each(function() {
                    $(this).attr('maxlength', 1);
                    $(this).on('keyup', function(e) {
                        var parent = $($(this).parent());
                        if(e.keyCode === 8 || e.keyCode === 37) {
                        var prev = parent.find('input#' + $(this).data('previous'));
                            if(prev.length) {
                                $(prev).select();
                            }
                        } else if((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 39) {
                            var next = parent.find('input#' + $(this).data('next'));
                            
                            if(next.length) {
                                $(next).select();
                            } else {
                                //if(parent.data('autosubmit')) {
                                    self.$$verify.trigger('click');
                              //  }
                            }
                        }
                    });
                });
              },
               buttons: {
                  verify: {
                      text: 'VERIFIY & PROCEED',
                      btnClass: 'btn btn-success btn-sm',
                      action: function(){
                                var form = this.$content.find("form");
                                var mobile = this.$content.find("input[name='new_mobile']").val();
                                var is_validate = false;
                                $(".is-invalid").removeClass("is-invalid");
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
                                        if(data.status==true) {
                                            var is_validate = true;
                                            crpConfirm.close();
                                            $.alert({
                                                columnClass: 'medium',
                                                title: 'Success',
                                                icon: 'fa fa-check',
                                                type: 'green',
                                                content: data.message,
                                            });

                                            $("#user-profile-mobile").val(mobile); 

                                        }  else {
                                            $.alert({
                                                columnClass: 'medium',
                                                title: 'Error',
                                                icon:  'fa fa-warning',
                                                type:  'red',
                                                content: data.message,
                                            });
                                            var is_validate = false;
                                        }
                                    },error: function (xhr, ajaxOptions, thrownError) {
                                        var errors = JSON.parse(xhr.responseText);
                                        var title =   JSON.parse(xhr.responseText).message;
                                        formErrorsflash(errors.errors, form.attr('id'));
                                        $.alert({
                                        columnClass: 'medium',
                                        title: 'Error',
                                        icon:  'fa fa-warning',
                                        type:  'red',
                                        content: '<ul>' + printErrorMsg(errors.errors) + '</ul>',
                                    });
                                    }
                                });
                                console.log(is_validate);
                                if(!is_validate){
                                    return false
                                }
                      }
                  },
                  resend: {
                      resendotp: 'RESEND OTP',
                      btnClass: 'btn btn-success btn-sm resendOtpBtn',

                      action: function(){
                            var form = this.$content.find('form');
                                var is_validate = false;
                                $(".is-invalid").removeClass("is-invalid");
                                var l = Ladda.create(document.querySelector('.resendOtpBtn'));
                                $.ajax({
                                    url: form.attr('action'),
                                    type: 'post',
                                    dataType: 'json',
                                    async: false,
                                    data: {reset_otp: true},
                                    beforeSend: function (xhr) {
                                        l.start();
                                    },
                                    headers: {
                                        "accept": "application/json",
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    success: function (data) {
                                        $.alert(data.message);
                                    },
                                    complete: function() {
                                        l.stop();
                                    },
                                    error: function (xhr, ajaxOptions, thrownError) {
                                        var errors = JSON.parse(xhr.responseText);
                                        var title =   JSON.parse(xhr.responseText).message;
                                        formErrorsflash(errors.errors, form.attr('id'));
                                        $.alert({
                                            columnClass: 'medium',
                                            title: 'Error',
                                            icon:  'fa fa-warning',
                                            type:  'red',
                                            content: '<ul>' + printErrorMsg(errors.errors) + '</ul>',
                                        });
                                    }
                                });
                                console.log(is_validate);
                                if(!is_validate){
                                    return false
                                }
                      }
                  },
                  Cancel: {
                      text: 'Close',
                      btnClass: 'btn btn-danger',
                  }
              }
          });
      }

      sendInvitation = (obj) => {
        var commonMes = new common();
        var l = Ladda.create(document.querySelector('#sendInvitation'));
        $.ajax({
            url: obj.url,
            type: 'POST',
            dataType: 'json',
            data: obj.filters,
            headers: {
                "accept": "application/json",
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function (xhr) {
                l.start();
            },
            complete: function() {
                l.stop();
            },
            success: function (data) {
                if(data.status == true){
                    commonMes.success(data);
                    $("#invitationEmails").val('');
                }else{
                    commonMes.errorAlert(data);
                }
            },error: function (xhr, ajaxOptions, thrownError) {
                var errors = JSON.parse(xhr.responseText);
                var title =   JSON.parse(xhr.responseText).message;
                commonMes.errorAlert({ title: title,message: commonMes.ajaxErrors(errors.errors)});
            }

        });
      }

      viewInvitation = (obj) => {
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
            },
             buttons: {
                Cancel: {
                    text: 'Close',
                    btnClass: 'btn btn-danger btn-sm',
                }
            }
        });
      }

      addDocuments = (obj) => {
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
               
                $('.dropify').dropify();

            },
             buttons: {
                submit: {
                    text: 'Save',
                    btnClass: 'btn btn-block btn-success btn-sm',
                    action: function(){
                        var form = this.$content.find("form");
                        // var title = this.$content.find("input[name='title']").val();
                       
                        var is_saved = false;

                        var formObj = form[0]; // You need to use standard javascript object here
                        var formData = new FormData(formObj);

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
                                    //commonMes.successReload(data);
                                    $("#userDocsTable tbody").append(data.uidata);
                                    $("#userDocsTable tbody tr").each(function(inc) {
                                      $( this ).find( "td.srn" ).html( (inc + 1) + ".");
                                    });
                                }
                                else{
                                    //commonMes.errorAlert(data);
                                    //commonMes.errorAlert(data.errors, form);
                                    commonMes.errorAlert({ title: data.message,message: data.errors});
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
                    btnClass: 'btn btn-block btn-danger btn-sm',
                }
            }
        });
      }

      deleteDocuments = (obj) => {
            var _this = obj;
            var message = 'Are you sure want to delete this record?';
            $.confirm({
                title: 'Alert',
                content: message,
                //icon: 'fa fa-exclamation-circle',
                // animation: 'scale',
                // closeAnimation: 'scale',
                // opacity: 0.5,
                // theme: 'supervan',
                buttons: {
                    'confirm': {
                        text: 'Yes',
                        btnClass: 'btn-blue',
                        action: function() {
                            $.ajax({
                                url: obj.url,
                                type: 'DELETE',
                                dataType: 'json',
                                beforeSend: function (xhr) {
                                    xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                                },
                                headers: {
                                    "accept": "application/json",
                                },
                                success: function(record) {
                                    if (record.status == true) {
                                       $(".doc-row-" + record.data.id).remove();
                                       $("#userDocsTable tbody tr").each(function(inc) {
                                            $( this ).find( "td.srn" ).html( (inc + 1) + ".");
                                        });
                                    }else{
                                        $.alert({
                                                columnClass: 'medium',
                                                title: 'Error',
                                                icon:  'fa fa-warning',
                                                type:  'red',
                                                content: record.message,
                                            });
                                    }
                                },
                                error: function(xhr, ajaxOptions, thrownError) {
                                   var commonMes = new common();
                                    var errors = JSON.parse(xhr.responseText);
                                    var title =   JSON.parse(xhr.responseText).message;
                                    commonMes.errorAlert({ title: title,message: commonMes.ajaxErrors(errors.errors)});
                                }
                            });
                        }
                    },
                    cancelAction: {
                        text: 'Cancel',
                    }
                }
            });
      }

      loadTeachers = (obj) => {
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
                    $(".teacherLoad").LoadingOverlay("show");
                },
                success: function (response) {
                    $(".teacherLoad").html(response);
                },complete: function() {
                        $(".teacherLoad").LoadingOverlay("hide");
                },error: function (xhr, ajaxOptions, thrownError) {
                        $(".teacherLoad").LoadingOverlay("hide");
                    var errors = JSON.parse(xhr.responseText);
                    var title =   JSON.parse(xhr.responseText).message;
                    alert(title);
                }

            });
      }

      getReviews = (obj) => {
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
            },
             buttons: {
                Cancel: {
                    text: 'Close',
                    btnClass: 'btn btn-danger btn-sm',
                }
            }
        });
      }

      bookSession = (obj) => {
        var _userCls = this;
        var commonMes = new common();
        let crpConfirm =  $.confirm({
            useBootstrap: false,
            boxWidth: '40%',
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
                $("#start_date").datetimepicker({
                    format: 'Y-m-d H:i:s',
                    step: 60,
                    onShow: function () {
                                this.setOptions({
                                    //minDate: 0,
                                    minDate: $('#end_date').val() ? $('#end_date').val() : 0
                                });
                            } 
                    }).attr('readonly', 'readonly');

                $( "#end_date" ).datetimepicker({
                        format: 'Y-m-d H:i:s',
                        step: 60,
                        onShow: function () {
                                this.setOptions({
                                    minDate:$('#start_date').val() ? $('#start_date').val() : 0,
                                    //minTime:$('#fdate').val()?$('#fdate').val():false
                                });
                            }                    
                    }).attr('readonly', 'readonly'); 
            },
             buttons: {
                submit: {
                    text: 'Book Session',
                    btnClass: 'btn btn-success',
                    action: function(){
                        var form = this.$content.find("form");
                       
                        var is_saved = false;
                        $.ajax({
                            url: form.attr('action'),
                            type: 'POST',
                            dataType: 'json',
                            async: false,
                            data: form.serialize(),
                            headers: {
                                "accept": "application/json",
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (data) {
                                console.log(data.data.id);
                                if(data.status==true){
                                    is_saved = true;
                                    commonMes.successReload(data);
                                   // crpConfirm.close();
                                   // _userCls.smcOtp({'title': 'OTP - Verification','profile_id': data.data.id,'url': data.data.otpUrl, filters: {profile_id: data.data.id}});
                                }
                                else{
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
                    btnClass: 'btn btn-danger',
                }
            }
        });
      }

      getSessionContent = (obj) => {
		  
          $("#commonModal").find(".modal-footer").html('');
        $.ajax({
            url: obj.url,
            dataType: "HTML",
            method: "GET",
            beforeSend: function(){
                if(!$('#commonModal').hasClass('in')) 
                    $("#commonModal").modal('show');

                $("#commonModal").find(".modal-title").html(obj.title);
                $("#commonModal").find(".modal-body").html('<div class="text-center"><img src="/img/loading.gif"></div>');
            },
            success: function(data){
                $("#commonModal").find(".modal-body").html(data);
                if(obj.type == "teacher"){
					if(obj.meeting == 1) {
						var ftr = '<a href="javascript:void(0);" data-id="'+ obj.id +'" class="btn btn-success modelAction accept" data-type="1"><i class="glyphicon glyphicon-ok"></i> ACCEPT</a>' +
						//'<a href="javascript:void(0);" class="btn btn-primary sessionModify" data-id="'+ obj.id +'"><i class="glyphicon glyphicon-pencil"></i> MODIFY</a>' +
						'<a href="javascript:void(0);" class="btn btn-danger modelAction sessionDecline" data-type="2" data-id="'+ obj.id +'"><i class="glyphicon glyphicon-remove"></i> DECLINE</a>';
					}
                    $("#commonModal").find(".modal-content").removeClass('DModal');
                    $("#commonModal").find(".modal-content").addClass('Mcourse');
                    console.log(obj.sessionStatus)
                    if(obj.sessionStatus != 1 && obj.sessionStatus != 2){
                        $("#commonModal").find(".modal-footer").html(ftr);
                    }else{
                       // console.log("ho gya")
                        $("#commonModal").find(".modal-footer").html('');
                    }
                    
                }else{
                    $("#commonModal").find(".modal-content").addClass('DModal');
                    $("#commonModal").find(".modal-footer").html('<button type="button" class="btn" data-dismiss="modal">Close</button>');
                }
                
            },
            error: function(error){
                console.log(error)
            }
        })
      }

    modelAction = (obj) => {
        var commonMes = new common();
        $.ajax({
            url: obj.url,
            type: 'POST',
            dataType: 'json',
            data: obj.data,
            beforeSend: function(){
               
            },
            headers: {
                "accept": "application/json",
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data){
                if(data.status==true){
                    commonMes.successReload(data);
                   // crpConfirm.close();
                   // _userCls.smcOtp({'title': 'OTP - Verification','profile_id': data.data.id,'url': data.data.otpUrl, filters: {profile_id: data.data.id}});
                }
                else{
                    commonMes.validationErrors(data.errors, form);
                    return false;
                }
            },
            error: function(xhr, ajaxOptions, thrownError){
                var errors = JSON.parse(xhr.responseText);
                var title =   JSON.parse(xhr.responseText).message;
                commonMes.errorAlert({ title: title,message: commonMes.ajaxErrors(errors.errors)});
            }
        })
    }

    sessionModify = (obj) => {
        $.ajax({
            url: obj.url,
            dataType: "HTML",
            method: "GET",
            data: obj.data,
            beforeSend: function(){
                if(!$('#commonModal').hasClass('in')) 
                    $("#commonModal").modal('show');

                $("#commonModal").find(".modal-title").html('Re-schedule');
                $("#commonModal").find(".modal-body").html('<div class="text-center"><img src="/img/loading.gif"></div>');
                $("#commonModal").find(".modal-footer").html('');
            },
            success: function(data){
                $("#commonModal").find(".modal-body").html(data);
                var ftr = '<a href="javascript:void(0);" class="btn btn-primary sessionReschedule" data-id="'+ obj.id +'"><i class="glyphicon glyphicon-pencil"></i> MODIFY</a>' + 
                '<button type="button" class="btn" data-dismiss="modal">Close</button>';
                    $("#commonModal").find(".modal-content").removeClass('DModal');
                    $("#commonModal").find(".modal-content").addClass('Mcourse');
                    $("#commonModal").find(".modal-footer").html(ftr);
            },
            error: function(error){
                console.log(error)
            }
        })
      }

      sessionReschedule = (obj) => {
        var commonMes = new common();
        $.ajax({
            url: obj.url,
            type: 'POST',
            dataType: 'json',
            data: obj.data,
            beforeSend: function(){
               
            },
            headers: {
                "accept": "application/json",
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data){
                if(data.status==true){
                    commonMes.successReload(data);
                   // crpConfirm.close();
                   // _userCls.smcOtp({'title': 'OTP - Verification','profile_id': data.data.id,'url': data.data.otpUrl, filters: {profile_id: data.data.id}});
                }
                else{
                    commonMes.validationErrors(data.errors, form);
                    return false;
                }
            },
            error: function(xhr, ajaxOptions, thrownError){
                var errors = JSON.parse(xhr.responseText);
                var title =   JSON.parse(xhr.responseText).message;
                commonMes.errorAlert({ title: title,message: commonMes.ajaxErrors(errors.errors)});
            }
        })
    }

  }
