class Listings {
    loaderClass = 'waitMe';

    constructor(business, stats) {
    }

    expenditureForm(obj) {
        var status = false;
        if(obj.stepNumber != undefined){
            if($("form#expenditureForm input[name='step_number']").length > 0){
                $("form#expenditureForm input[name='step_number']").val(obj.stepNumber);
            }else{
                $("form#expenditureForm").append( "<input name='step_number' type='hidden' value='" + obj.stepNumber + "'>" );
            }
        }
        $.ajax({
            async: false,
            url: obj.url,
            type: 'post',
            data: $("form#expenditureForm").serialize(),
            dataType: 'json',
            headers: {
                "accept": "application/json",
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                $('#step-3').waitMe();
            },
            complete: function() {
                setTimeout(function(){
                    $('#step-3').waitMe('hide');
                    }, 500);
            },
            success: function(response) {
                if(response.status == true){
                    status = true;
                    // $.alert({
                    //     columnClass: 'medium',
                    //     title: 'Success',
                    //     icon: 'fa fa-check',
                    //     type: 'green',
                    //     content: response.message,
                    //     buttons: {
                    //         save: {
                    //             text: 'Next',
                    //             btnClass: 'btn btn-block btn-success btn-sm',
                    //             action: function(){
                    //                 status = true;
                    //             }
                    //         }
                    //     }
                    // });

                }else{
                    console.log(response.message_type);
                    if(response.message_type == "skip"){
                        status = true;
                    }else{
                        status = false;
                    }

                    // $.alert({
                    //     columnClass: 'medium',
                    //     title: 'Error',
                    //     icon:  'fa fa-warning',
                    //     type:  'red',
                    //     content: response.message,
                    //     buttons: {
                    //         skip: {
                    //             text: 'Skip',
                    //             btnClass: 'btn btn-block btn-success btn-sm',
                    //             action: function(){
                    //                 status = true;
                    //                 $('#smartwizard').smartWizard("next");
                    //             }
                    //         },
                    //         Cancel: {
                    //             text: 'Cancel',
                    //             btnClass: 'btn btn-block btn-secondary btn-sm',
                    //         }
                    //     }
                    // });
                }
            },error: function (xhr, ajaxOptions, thrownError) {
                var errors = JSON.parse(xhr.responseText);
                var title =   JSON.parse(xhr.responseText).message;
                formErrorsflash(errors.errors, obj.formId);
                // $.alert({
                //     columnClass: 'medium',
                //     title: 'Error',
                //     icon:  'fa fa-warning',
                //     type:  'red',
                //     content: '<ul>' + printErrorMsg(errors.errors) + '</ul>',
                //  });
                // console.log(errors.errors);
            }
        });
        return status;

      }
    affordability(obj) {
    var status = false;
    if(obj.stepNumber != undefined){
        if($("form#affordabilityForm input[name='step_number']").length > 0){
            $("form#affordabilityForm input[name='step_number']").val(obj.stepNumber);
        }else{
            $("form#affordabilityForm").append( "<input name='step_number' type='hidden' value='" + obj.stepNumber + "'>" );
        }
    }
    $.ajax({
        async: false,
        url: obj.url,
        type: 'post',
        data: $("form#affordabilityForm").serialize(),
        dataType: 'json',
        headers: {
            "accept": "application/json",
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function() {
            $('#smartwizard').smartWizard("loader", "show");
        },
        complete: function() {
            setTimeout(function(){
                $('#smartwizard').smartWizard("loader", "hide");
                }, 500);
        },
        success: function(response) {
            if(response.status == true){
                status = true;
            }else{
                console.log(response.message_type);
                if(response.message_type == "skip"){
                    status = true;
                }else{
                    status = false;
                }
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
            console.log(errors.errors);
        }
    });
    return status;
    }
    propertyDetail(obj) {
        var status = false;
        if(obj.stepNumber != undefined){
            if($("form#propertyItemsForm input[name='step_number']").length > 0){
                $("form#propertyItemsForm input[name='step_number']").val(obj.stepNumber);
            }else{
                $("form#propertyItemsForm").append( "<input name='step_number' type='hidden' value='" + obj.stepNumber + "'>" );
            }
        }
        $.ajax({
            async: false,
            url: obj.url,
            type: 'post',
            data: $("form#propertyItemsForm").serialize(),
            dataType: 'json',
            headers: {
                "accept": "application/json",
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                $('#smartwizard').smartWizard("loader", "show");
            },
            complete: function() {
                setTimeout(function(){
                    $('#smartwizard').smartWizard("loader", "hide");
                    }, 500);
            },
            success: function(response) {
                if(response.status == true){
                    status = true;
                }else{
                    console.log(response.message_type);
                    if(response.message_type == "skip"){
                        status = true;
                    }else{
                        status = false;
                    }
                }
            },error: function (xhr, ajaxOptions, thrownError) {
                var errors = JSON.parse(xhr.responseText);
                var title =   JSON.parse(xhr.responseText).message;
                formErrorsflash(errors.errors, obj.formId);
                // $.alert({
                //     columnClass: 'medium',
                //     title: 'Error',
                //     icon:  'fa fa-warning',
                //     type:  'red',
                //     content: '<ul>' + printErrorMsg(errors.errors) + '</ul>',
                //     });
                console.log(errors.errors);
            }
        });
        return status;
        }
    otherAsset(obj) {
        var status = false;
        if(obj.stepNumber != undefined){
            if($("form#otherbudgetAssetsForm input[name='step_number']").length > 0){
                $("form#otherbudgetAssetsForm input[name='step_number']").val(obj.stepNumber);
            }else{
                $("form#otherbudgetAssetsForm").append( "<input name='step_number' type='hidden' value='" + obj.stepNumber + "'>" );
            }
        }
        $.ajax({
            async: false,
            url: obj.url,
            type: 'post',
            data: $("form#otherbudgetAssetsForm").serialize(),
            dataType: 'json',
            headers: {
                "accept": "application/json",
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                $('#smartwizard').smartWizard("loader", "show");
            },
            complete: function() {
                setTimeout(function(){
                    $('#smartwizard').smartWizard("loader", "hide");
                    }, 500);
            },
            success: function(response) {
                if(response.status == true){
                    status = true;
                }else{
                    console.log(response.message_type);
                    if(response.message_type == "skip"){
                        status = true;
                    }else{
                        status = false;
                    }
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
                console.log(errors.errors);
            }
        });
        return status;
        }
    mortgageProtection(obj) {
        var status = false;
        if(obj.stepNumber != undefined){
            if($("form#mortgageProtectionForm input[name='step_number']").length > 0){
                $("form#mortgageProtectionForm input[name='step_number']").val(obj.stepNumber);
            }else{
                $("form#mortgageProtectionForm").append( "<input name='step_number' type='hidden' value='" + obj.stepNumber + "'>" );
            }
        }
        $.ajax({
            async: false,
            url: obj.url,
            type: 'post',
            data: $("form#mortgageProtectionForm").serialize(),
            dataType: 'json',
            headers: {
                "accept": "application/json",
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                $('#smartwizard').smartWizard("loader", "show");
                $(".is-invalid").removeClass("is-invalid");
            },
            complete: function() {
                setTimeout(function(){
                    $('#smartwizard').smartWizard("loader", "hide");
                    }, 500);
            },
            success: function(response) {
                if(response.status == true){
                    status = true;
                }else{
                    console.log(response.message_type);
                    if(response.message_type == "skip"){
                        status = true;
                    }else{
                        status = false;
                    }
                }
            },error: function (xhr, ajaxOptions, thrownError) {
                var errors = JSON.parse(xhr.responseText);
                var title =   JSON.parse(xhr.responseText).message;
                formErrorsflash(errors.errors, "mortgageProtectionForm");
                // $.alert({
                //     columnClass: 'medium',
                //     title: 'Error',
                //     icon:  'fa fa-warning',
                //     type:  'red',
                //     content: '<ul>' + printErrorMsg(errors.errors) + '</ul>',
                //     });
            }
        });
        return status;
    }
    saveFormdata(obj) {
        var status = false;
        if(obj.stepNumber != undefined){
            if($("form#"+obj.formId+" input[name='step_number']").length > 0){
                $("form#"+obj.formId+" input[name='step_number']").val(obj.stepNumber);
            }else{
                $("form#"+obj.formId).append( "<input name='step_number' type='hidden' value='" + obj.stepNumber + "'>" );
            }
        }
        $.ajax({
            async: false,
            url: obj.url,
            type: 'post',
            data: $("form#"+obj.formId).serialize(),
            dataType: 'json',
            headers: {
                "accept": "application/json",
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                $('#smartwizard').smartWizard("loader", "show");
                $(".is-invalid").removeClass("is-invalid");
            },
            complete: function() {
                setTimeout(function(){
                    $('#smartwizard').smartWizard("loader", "hide");
                    }, 500);
            },
            success: function(response) {
                if(response.status == true){
                    status = true;
                }else{
                    console.log(response.message_type);
                    if(response.message_type == "skip"){
                        status = true;
                    }else{
                        status = false;
                    }
                }
            },error: function (xhr, ajaxOptions, thrownError) {
                var errors = JSON.parse(xhr.responseText);
                var title =   JSON.parse(xhr.responseText).message;
                formErrorsflash(errors.errors, obj.formId);
                $.alert({
                        columnClass: 'medium',
                        title: 'Error',
                        icon:  'fa fa-warning',
                        type:  'red',
                        content: '<ul>' + printErrorMsg(errors.errors) + '</ul>',
                });
            }
        });
        return status;
    }
    summaryOfAdvice(obj) {
        var status = false;
        if(obj.stepNumber != undefined){
            if($("form#"+obj.formId+" input[name='step_number']").length > 0){
                $("form#"+obj.formId+" input[name='step_number']").val(obj.stepNumber);
            }else{
                $("form#"+obj.formId).append( "<input name='step_number' type='hidden' value='" + obj.stepNumber + "'>" );
            }
        }
        $.ajax({
            async: false,
            url: obj.url,
            type: 'post',
            data: $("form#"+obj.formId).serialize(),
            dataType: 'json',
            headers: {
                "accept": "application/json",
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                $('#smartwizard').smartWizard("loader", "show");
                $(".is-invalid").removeClass("is-invalid");
            },
            complete: function() {
                setTimeout(function(){
                    $('#smartwizard').smartWizard("loader", "hide");
                    }, 500);
            },
            success: function(response) {
                if(response.status == true){
                    status = true;
                }else{
                    console.log(response.message_type);
                    if(response.message_type == "skip"){
                        status = true;
                    }else{
                        status = false;
                    }
                }
            },error: function (xhr, ajaxOptions, thrownError) {
                var errors = JSON.parse(xhr.responseText);
                var title =   JSON.parse(xhr.responseText).message;
                formErrorsflash(errors.errors, obj.formId);
            }
        });
        return status;
    }
  }
