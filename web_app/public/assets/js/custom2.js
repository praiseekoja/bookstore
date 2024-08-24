jQuery(document).ready(($) => {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });


    $('#add_subj').submit((e) => {
        e.preventDefault();

        let form_data = new FormData(document.getElementById('add_subj'));
        blockUI("Verifying details, please wait...");
        $.ajax({
            url: "/subject",
            type: 'POST',
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: (data) => {
                unblockUI()
                showSuccess("Success", data.responseJSON.message.split('.')[0]+'.')
            },
            error: (data) => {
                unblockUI()
                showError('Error:', data.responseJSON.message.split('.')[0]+'.');
            }
        });
    })

    $('#edit_subj').submit((e) => {
        e.preventDefault();

        let form_data = new FormData(document.getElementById('edit_subj'));
        blockUI("Verifying details, please wait...");
        $.ajax({
            url: `/subject/${form_data.get('id')}`,
            type: 'POST',
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: (data) => {
                unblockUI()
                showSuccess("Success:", 'Saved!!!')
            },
            error: (data) => {
                unblockUI()
                showError('Error:', data.responseJSON.message.split('.')[0]+'.');
            }
        });
    })

    $('#add_class').submit((e) => {
        e.preventDefault();

        let form_data = new FormData(document.getElementById('add_class'));
        blockUI("Verifying details, please wait...");
        $.ajax({
            url: "/class",
            type: 'POST',
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: (data) => {
                unblockUI()
                showSuccess("Success", 'Saved!!')
            },
            error: (data) => {
                unblockUI()
                showError('Error:', 'An error occurred, Try again');
            }
        });
    })

    $('#edit_class').submit((e) => {
        e.preventDefault();

        let form_data = new FormData(document.getElementById('edit_class'));
        blockUI("Verifying details, please wait...");
        $.ajax({
            url: `/class/${form_data.get('id')}`,
            type: 'POST',
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: (data) => {
                unblockUI()
                showSuccess("Success:", 'Saved!!!')
            },
            error: (data) => {
                unblockUI()
                showError('Error:', 'An error occurred, Try again');
            }
        });
    })


    $('#edit_user').submit((e) => {
        e.preventDefault();

        let form_data = new FormData(document.getElementById('edit_user'));
        blockUI("Verifying details, please wait...");
        $.ajax({
            url: `/user/${form_data.get('id')}`,
            type: 'POST',
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: (data) => {
                unblockUI()
                showSuccess("Success:", 'Saved!!!')
            },
            error: (data) => {
                unblockUI()
                showError('Error:', 'An error occurred, Try again');
            }
        });
    })


    $('#add_book').submit((e) => {
        e.preventDefault();

        let form_data = new FormData(document.getElementById('add_book'));

        try {
            let price = convertToDouble(form_data.get('price'))
            form_data.set('price', price)
        } catch (error) {
            showError("Error:", "Invalid price");
            return
        }

        blockUI("Verifying details, please wait...");
        $.ajax({
            url: "/book",
            type: 'POST',
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: () => {
                unblockUI()
                showSuccess("Success", 'Saved!!')
            },
            error: () => {
                unblockUI()
                showError('Error:', 'An error occurred, Try again');
            }
        });
    })

    $('#edit_book').submit((e) => {
        e.preventDefault();

        let form_data = new FormData(document.getElementById('edit_book'));
        blockUI("Verifying details, please wait...");
        $.ajax({
            url: `/book/${form_data.get('id')}`,
            type: 'POST',
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: () => {
                unblockUI()
                showSuccess("Success:", 'Saved!!!')
            },
            error: () => {
                unblockUI()
                showError('Error:', 'An error occurred, Try again');
            }
        });
    })

    $('#edit_sec').submit((e) => {
        e.preventDefault();

        let form_data = new FormData(document.getElementById('edit_sec'));
        blockUI("Verifying details, please wait...");
        $.ajax({
            url: `/auth/admin`,
            type: 'POST',
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: () => {
                unblockUI()
                showSuccess("Success:", 'Saved!!!')
            },
            error: () => {
                unblockUI()
                showError('Error:', 'An error occurred, Try again');
            }
        });
    })



    function showInfo(title = null, message = null) {
        iziToast.info({
            title,
            message,
            position: 'center'
        });
    }

    function showSuccess(title = "Success", message = null) {
        iziToast.success({
            title,
            message,
            position: 'center'
        });
    }

    function showError(title = "Error", message = "An error occured") {
        iziToast.error({
            title,
            message,
            position: 'center'
        });
    }

    function blockUI(message = 'Loading please wait...') {
        return $.blockUI({
            css: {
                border: 'none',
                padding: '15px',
                backgroundColor: '#000',
                '-webkit-border-radius': '10px',
                '-moz-border-radius': '10px',
                opacity: .5,
                color: '#fff'
            },
            message: message
        });
    }

    function unblockUI() {
        return $.unblockUI();
    }

    function convertToDouble(cuurency) {
        var temp = cuurency.replace(/[^0-9.-]+/g, "");
        return parseFloat(temp);
    }
});
