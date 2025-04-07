function openModalBox(modalId, url, title, val = "") {

    $.ajax({
        type: 'GET',
        url: url,
        data: {
            val: val,
        },
        success: function(result) {
            $(`#${modalId}_title`).html(title);
            $(`#${modalId}_body`).html(result);
            $(`#${modalId}`).modal('show');
        }
    });
}

function renderData(data, type, row) {
    if (data === null || data === undefined) {
        return ''; // Return an empty string for null or undefined values
    }
    return data; // Return the actual data
}

function addUpdateData(buttonId,formId,modalId,reload,redirect = '') {
    var formId=formId;
    var buttonId=buttonId;
    $(`button[id="${buttonId}"]`).attr('disabled', 'disabled');
    $(`button[id="${buttonId}"] .indicator-label`).css('display', 'none');
    $(`button[id="${buttonId}"] .indicator-progress`).css('display', 'block');
    $.ajax({
        url: $(`#${formId}`).attr('action'),
        method: 'POST',
        data: new FormData($(`#${formId}`)[0]),
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
        success: function(result) {

            $(`button[id="${buttonId}"]`).removeAttr("disabled");
            $(`button[id="${buttonId}"] .indicator-progress`).css("display", "none");
            $(`button[id="${buttonId}"] .indicator-label`).css("display", "block");

            toastrAll(result.status, result.message);
            $(`#${modalId}`).modal('hide');
            if(reload == 'yes')
            {
                setTimeout(function() {
                    window.location.reload()
                  }, 2000);
            }
            else if(redirect != '')
            {
                setTimeout(function() {
                    window.location.replace(redirect);
                  }, 2000);
                
            }
            else
            {
                dt.draw();
            }
        },
        error: function(xhr, status, error) {
            $(`button[id="${buttonId}"]`).removeAttr("disabled");
            $(`button[id="${buttonId}"] .indicator-progress`).css("display", "none");
            $(`button[id="${buttonId}"] .indicator-label`).css("display", "block");
            
            if (xhr.status == 401) {
                alert("Your Session Expired. Please Login Again.");
                window.location.reload();
            } else if (xhr.status == 422) {
                $("#" + formId).find("span.myClass").remove();
    
                $.each(xhr.responseJSON.errors, function (i, error) {
                    var el = $(document).find('[name="' + i + '"]');
                    if (el.length === 0) {
                        el = $(document).find('[name="' + i + '[]"]');
                    }
                    if (el[0].type == "select-multiple" || el[0].type == "select-one") {
                        spanerror = $('<span class="myClass" style="color: red;">' + error[0] + '</span>');
                        el[0].parentElement.children[1].after(spanerror[0]);
                    } else {
                        el.after($('<span class="myClass" style="color: red;">' + error[0] + '</span>'));
                    }
                });
            } else if (xhr.status == 500) {
                alert("Something went wrong. Please contact the admin.");
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
    
}
function deleteSweerAlert(text, url, redirect = '') {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        confirmButtonColor: '#dc3545',
    }).then(function(result) {
        if (result.value) {
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    _token: document.head.querySelector('meta[name="_token"]').content,
                    _method: 'DELETE',
                },
                success: function(result) {
                    Swal.fire('Deleted!', `${text}`, 'success');
                    if (redirect != '') {
                        window.location.replace(redirect);
                    } else {
                        dt.draw();
                    }
                }
            })
        }
    });
}

function validateNumbers(key) {
    //getting key code of pressed key
    var keycode = key.which ? key.which : key.keyCode;
    //comparing pressed keycodes
    if (!(keycode == 8 || keycode == 46) && (keycode < 48 || keycode > 57)) {
        return false;
    } else {
        return true;
    }
}

function validateAlphabets(evt) {
    evt = evt ? evt : window.event;
    var charCode = evt.which ? evt.which : evt.keyCode;
    if (
        !(charCode >= 65 && charCode <= 123) &&
        charCode != 32 &&
        charCode != 0
    ) {
        return false;
    } else {
        return true;
    }
}

function validateEmail(EMAIL) {
    var filter =
        /^([\w-]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    if (filter.test(EMAIL)) {
        return true;
    } else {
        return false;
    }
}

function toastrAll(status, message) {
    toastr.options = {
        closeButton: false,
        debug: false,
        newestOnTop: false,
        progressBar: false,
        positionClass: "toastr-top-right",
        preventDuplicates: false,
        onclick: null,
        showDuration: "300",
        hideDuration: "1000",
        timeOut: "5000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
    };

    if (status == "success") {
        toastr.success(message);
    } else if (status == "warning") {
        toastr.warning(message);
    } else if (status == "info") {
        toastr.info(message);
    } else if (status == "error") {
        toastr.error(message);
    }
}
function numberFormate(value) {
    return new Intl.NumberFormat('en-US', {}).format(value)
}
// $(document).ajaxError(function myErrorHandler(
//     event,
//     xhr,
//     ajaxOptions,
//     thrownError
// ) {
//     $('button[id="submitbutton"]').removeAttr("disabled");
//     $(".indicator-progress").css("display", "none");
//     $(".indicator-label").css("display", "block");
//     // debugger
//     if (xhr.status == 401) {
//         alert("Your Session Expire Please Login Again");
//         window.location.reload();
//     }
//     if (xhr.status == 422) {
//         // if(ajaxOptions.url.includes("updatePassword"))
//         // {
//         //     $("#" + event.target.forms[2].id)
//         //     .find("span.myClass")
//         //     .remove();
//         // }
//         // else
//         // {
//             $("#" + event.target.forms[0].id)
//             .find("span.myClass")
//             .remove();
//         // }
//         // when status code is 422, it's a validation issue
//         $.each(xhr.responseJSON.errors, function (i, error) {
//             var el = $(document).find('[name="' + i + '"]');
//             if (el.length === 0) {
//                 var el = $(document).find('[name="' + i + '[]"]');
//             }
//             if (el[0].type == "select-multiple") {
//                 spanerror = $(
//                     '<span class="myClass" style="color: red;">' +
//                         error[0] +
//                         "</span>"
//                 );
//                 el[0].parentElement.children[1].after(spanerror[0]);
//             } else if (el[0].type == "select-one") {
//                 spanerror = $(
//                     '<span class="myClass" style="color: red;">' +
//                         error[0] +
//                         "</span>"
//                 );
//                 el[0].parentElement.children[1].after(spanerror[0]);
//             } else {
//                 el.after(
//                     $(
//                         '<span class="myClass" style="color: red;">' +
//                             error[0] +
//                             "</span>"
//                     )
//                 );
//             }
//         });
//     } else if (xhr.status == 500) {
//         alert("Something went wrong call the admin");
//     }
// });

