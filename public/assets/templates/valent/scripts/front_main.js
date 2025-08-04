
//initiate aos
AOS.init();


function toastNotify(type, message) {
    Swal.fire({
        icon: type,
        html: message,
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter',
                Swal.stopTimer);
            toast.addEventListener('mouseleave',
                Swal.resumeTimer);
        }
    });
}

////////////////// contact form
$(document).on('submit', '.gen-form', function (e) {
    e.preventDefault();

    var form = $(this);
    var successAction = $(this).data('action');
    var redirectUrl = $(this).data('url');
    var formData = new FormData(this);

    var submitButton = form.find('button[type="submit"]');
    submitButton.addClass('relative disabled');
    submitButton.prop('disabled', true);
    var passwordInputs = form.find('input[type="password"]');

    $.ajax({
        url: form.attr('action'),
        method: 'POST',
        data: formData,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function (response) {
            var message = response.message;
            // Check if password inputs exist and clear their values
            if (successAction !== 'none') {
                if (passwordInputs.length > 0) {
                    passwordInputs.val('');
                }
            }
     
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: 'Success!',
                text: message,
                showConfirmButton: false,
                timer: 1500
              });

            if (successAction === 'reload') {
                $.ajax({
                    url: window.location.href,
                    method: 'GET',
                    success: function (response) {
                        $('#refresh').html($(response).find('#refresh').html());
                        if ($(".slider-input").length > 0) {
                            initializeSliders();
                        }
                    },
                    error: function () {
                        console.error('Error fetching new content');
                    }
                });
            } else if (successAction === 'redirect') {
                if (redirectUrl) {
                    window.location.href = redirectUrl;
                }
            } else if (successAction === 'reset') {
                form.find('input[type!="hidden"]').val('');
            }
        },
        error: function (xhr) {
            var errors = xhr.responseJSON ? xhr.responseJSON.errors : null;
            var errorMessage = 'An error occurred. Please try again later.';

            if (errors) {
                errorMessage = '';
                $.each(errors, function (field, messages) {
                    $.each(messages, function (index, message) {
                        errorMessage += message + '<br>';
                    });
                });
            }

            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Error!",
                html: errorMessage,
                showConfirmButton: false,
                timer: 1500
              });
        },
        complete: function () {
            submitButton.removeClass('disabled');
            submitButton.prop('disabled', false);
        }
    });

    
});


