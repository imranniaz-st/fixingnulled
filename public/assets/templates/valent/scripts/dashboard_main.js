
// update count down
 
}

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

$(document).ready(function() {
    // Toggle sidebar visibility
    $('#toggle-sidebar').click(function() {
      $('#sidebar').toggleClass('hidden');
    });

    $('#toggle-close').click(function() {
      $('#sidebar').toggleClass('hidden');
    });

    // Toggle right dropdown visibility
    $('#right_dropdown_btn').click(function() {
      $('#right-dropdown').toggleClass('hidden');
    });

    // Toggle status dropdown visibility
    $('.status-dropdown-btn').click(function() {
      $('.status-dropdown').toggleClass('hidden');
    });


    // Hide sidebar and dropdown when clicking outside
    $(document).mouseup(function(e) {
      const $sidebar = $('#sidebar');
      const $rightDropdown = $('#right-dropdown');
      const $statusDropdown = $('#status-dropdown');

      // Check if click is outside the sidebar and toggle button
      if (!$sidebar.is(e.target) && $sidebar.has(e.target).length === 0 && 
          !$('#toggle-sidebar').is(e.target)) {
        $sidebar.addClass('hidden');
      }

      // Check if click is outside the right dropdown and button
      if (!$rightDropdown.is(e.target) && $rightDropdown.has(e.target).length === 0 && 
          !$('#right_dropdown_btn').is(e.target)) {
        $rightDropdown.addClass('hidden');
      }

      // Check if click is outside the status dropdown and button
      if (!$statusDropdown.is(e.target) && $statusDropdown.has(e.target).length === 0 && 
          !$('#status-dropdown-btn').is(e.target)) {
        $statusDropdown.addClass('hidden');
      }
    });
  });

//initiate aos
AOS.init();

/*
// copy text to clipboard
$(document).on('click', '.clipboard', function () {
  const textToCopy = $(this).attr('data-copy');
  copyTextToClipboard(textToCopy);
  const message = textToCopy + ' copied';
  toastNotify('success', message);
});




function copyTextToClipboard(text) {
  const dummyTextArea = document.createElement('textarea');
  dummyTextArea.value = text;
  document.body.appendChild(dummyTextArea);
  dummyTextArea.select();
  document.execCommand('copy');
  document.body.removeChild(dummyTextArea);
}
*/


  ///////////////////////////////////////////////////////////// copy text to clipboard
  $(document).on("click", ".clipboard", function () {
    const textToCopy = $(this).attr("data-copy");
    copyTextToClipboard(textToCopy);
    const message = textToCopy + " copied";
    toastNotify("success", message);
});

function copyTextToClipboard(textToCopy) {
    if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard
            .writeText(textToCopy)
            .then(() => {
                const message = textToCopy + " copied";
                toastNotify("success", message);
            })
            .catch((err) => {
                //console.error("Clipboard API failed:", err);
                fallbackCopyText(textToCopy);
            });
    } else {
        fallbackCopyText(textToCopy);
    }
}

function fallbackCopyText(textToCopy) {
    const textArea = document.createElement("textarea");
    textArea.value = textToCopy;
    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();

    try {
        const successful = document.execCommand("copy");
        if (successful) {
            const message = textToCopy + " copied";
            toastNotify("success", message);
        } else {
            //console.error("Fallback: Copy command failed");
        }
    } catch (err) {
        //console.error("Fallback: Unable to copy", err);
    }

    document.body.removeChild(textArea);
}
///////////////////////////////////////////////////////////////



// load page via ajax
function loadPage(link, clicked, targetDiv) {
  $('#preloader').hide();
  if (clicked) {
      clicked.addClass('relative disabled');
      clicked.append('<span class="button-spinner"></span>');
      clicked.prop('disabled', true);
  }

  $.ajax({
      url: link,
      method: 'GET',
      success: function(response) {
          $(targetDiv).html($(response).find(targetDiv).html());
          var scrollTo = $(targetDiv).offset().top - 100;
          $('html, body').animate({
              scrollTop: scrollTo
          }, 800);
      },
      complete: function() {
          if (clicked) {
              clicked.removeClass('disabled');
              clicked.find('.button-spinner').remove();
              clicked.prop('disabled', false);
          }

      }
  });
}


// paginator navigation
$(document).on('click', ".paginator-link", function(e) {
  e.preventDefault();
  var link = $(this).attr('href');
  var clicked = $(this);
  var simplePagination = $(this).closest('.simple-pagination');

  var dataPaginator = simplePagination.attr('data-paginator');
  var targetDiv = '#' + dataPaginator;

  if (link) {
      loadPage(link, clicked, targetDiv);
      // Update the browser's URL without reloading the page
      // history.pushState(null, '', link);
  }
});



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
            icon: "success",
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