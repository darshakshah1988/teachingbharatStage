'use strict';

var stripe = Stripe(stripe_public_key);

function registerElements(elements, exampleName) {
  var formClass = '.' + exampleName;
  var example = document.querySelector(formClass);

  var form = example.querySelector('form.examPay');
//   var resetButton = example.querySelector('a.reset');
  var error = form.querySelector('.error');
  var errorMessage = error.querySelector('.message');

  function enableInputs() {
    Array.prototype.forEach.call(
      form.querySelectorAll(
        "input[type='text'], input[type='email'], input[type='tel']"
      ),
      function(input) {
        input.removeAttribute('disabled');
      }
    );
  }

  function disableInputs() {
    Array.prototype.forEach.call(
      form.querySelectorAll(
        "input[type='text'], input[type='email'], input[type='tel']"
      ),
      function(input) {
        input.setAttribute('disabled', 'true');
      }
    );
  }

  function triggerBrowserValidation() {
    // The only way to trigger HTML5 form validation UI is to fake a user submit
    // event.
    var submit = document.createElement('input');
    submit.type = 'submit';
    submit.style.display = 'none';
    form.appendChild(submit);
    submit.click();
    submit.remove();
  }

  // Listen for errors from each Element, and show error messages in the UI.
  var savedErrors = {};
  elements.forEach(function(element, idx) {
    element.on('change', function(event) {
      if (event.error) {
        error.classList.add('visible');
        savedErrors[idx] = event.error.message;
        errorMessage.innerText = event.error.message;
      } else {
        savedErrors[idx] = null;

        // Loop over the saved errors and find the first one, if any.
        var nextError = Object.keys(savedErrors)
          .sort()
          .reduce(function(maybeFoundError, key) {
            return maybeFoundError || savedErrors[key];
          }, null);

        if (nextError) {
          // Now that they've fixed the current error, show another one.
          errorMessage.innerText = nextError;
        } else {
          // The user fixed the last error; no more errors.
          error.classList.remove('visible');
        }
      }
    });
  });

  // Listen on the form's 'submit' handler...
  form.addEventListener('submit', function(e) {
    e.preventDefault();
    // Trigger HTML5 validation UI on the form if any of the inputs fail
    // validation.
    var plainInputsValid = true;
    Array.prototype.forEach.call(form.querySelectorAll('input'), function(
      input
    ) {
      if (input.checkValidity && !input.checkValidity()) {
        plainInputsValid = false;
        return;
      }
    });
    if (!plainInputsValid) {
      triggerBrowserValidation();
      return;
    }
    // Show a loading screen...
    example.classList.add('submitting');
    // Disable all inputs.
    disableInputs();
    // Gather additional customer data we may have collected in our form.
    var name = form.querySelector('#' + exampleName + '-name');
    var address1 = form.querySelector('#' + exampleName + '-address');
    var city = form.querySelector('#' + exampleName + '-city');
    var state = form.querySelector('#' + exampleName + '-state');
    var zip = form.querySelector('#' + exampleName + '-zip');
    var additionalData = {
      name: name ? name.value : undefined,
      address_line1: address1 ? address1.value : undefined,
      address_city: city ? city.value : undefined,
      address_state: state ? state.value : undefined,
      address_zip: zip ? zip.value : undefined,
    };
    // Use Stripe.js to create a token. We only need to pass in one Element
    // from the Element group in order to create a token. We can also pass
    // in the additional customer data we collected in our form.
    stripe.createToken(elements[0], additionalData).then(function(result) {
      // Stop loading!
      example.classList.remove('submitting');
      var l = Ladda.create( form.querySelector( '.payButton' ) );
      if (result.token) {
        // If we received a token, show the token ID.
        // example.querySelector('.token').innerText = result.token.id;
        // example.classList.add('submitted');
        $.ajax({
            url: getBookingPaymentUrl,
            dataType: 'json',
            type: 'post',
            data: {stripeToken: result.token.id},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function(xhr) {
                l.start();
            },
            success: function(data) {
                $.alert({
                    columnClass: 'medium',
                        title: data.status == true ? 'Success' : 'Error',
                        icon: data.status == true ? 'fa fa-check' : 'fa fa-warning',
                        type: data.status == true ? 'green' : 'red',
                        content: data.message,
                        buttons: {
                                Ok: function(){
                                    //location.reload();
                                    location.href = thankYouUrl
                                }
                            }
                    });

            },
            error: function (jqXHR, exception) {
                var response = JSON.parse(jqXHR.responseText);
                var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect.\n Verify Network.';
                } else if (jqXHR.status == 404) {
                    msg = 'Requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    msg = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else {
                    msg = 'Uncaught Error.\n' + jqXHR.responseText;
                }
                $.alert({
                        columnClass: 'medium',
                        title: msg,
                        icon: 'fa fa-warning',
                        type: 'red',
                        content: response.message,
                        buttons: {
                            close: function () {
                                text: 'Ok'
                            }
                        }
                    });
            },
            complete: function() {
                l.stop();
            }
        });


      } else {
        l.start();
        // Otherwise, un-disable inputs.
        $.alert({
          columnClass: 'medium',
          title: result.error.code,
          icon: 'fa fa-warning',
          type: 'red',
          content: result.error.message,
          buttons: {
              close: function () {
                  text: 'Ok'
              }
          }
        });
        enableInputs();
        l.stop();
      }
    });
  });

//   resetButton.addEventListener('click', function(e) {
//     e.preventDefault();
//     // Resetting the form (instead of setting the value to `''` for each input)
//     // helps us clear webkit autofill styles.
//     form.reset();

//     // Clear each Element.
//     elements.forEach(function(element) {
//       element.clear();
//     });

//     // Reset error state as well.
//     error.classList.remove('visible');

//     // Resetting the form does not un-disable inputs, so we need to do it separately:
//     enableInputs();
//     example.classList.remove('submitted');
//   });
}
