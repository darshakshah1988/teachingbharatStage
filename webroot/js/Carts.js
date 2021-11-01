class Carts {

    coupon = (obj) => {
        var commonMes = new common();
        $.ajax({
                url: obj.url,
                type: 'post',
                data: obj.filters,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    $('#button-coupon').button('loading');
                },
                complete: function() {
                    $('#button-coupon').button('reset');
                },
                success: function(data) {
                    $('.alert-dismissible').remove();

                    if(data.status == true){
                        commonMes.successReload(data);
                    }
                    else{
                        $.alert({
                            columnClass: 'medium',
                            title: (data.title != undefined && data.title != "") ? data.title : 'Success',
                            icon: 'fa fa-warning',
                            type: 'red',
                            content: data.message,
                            buttons: {
                                  Ok: function(){
                                      location.reload();
                                  }
                              }
                        });
                        //commonMes.validationErrors(data.errors, form);
                    }

                    // if (json['error']) {
                    //     $('.flashBox').html('<div class="alert alert-danger alert-dismissible"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');

                    //     $('html, body').animate({ scrollTop: 0 }, 'slow');
                    // }

                    // if (json['redirect']) {
                    //     location = json['redirect'];
                    // }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
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
  }
