jQuery(document).ready(($) => {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#login_formm').submit((e) => {
        e.preventDefault();

        let form_data = new FormData(document.getElementById('login_formm'));
        blockUI("Verifying details, please wait...");
        $.ajax({
            url: "/login",
            type: 'POST',
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: () => {
                window.location.href = "/user/dashboard"
                unblockUI()
            },
            error: (data) => {
                showError('Error:', data.responseJSON.message.split('.')[0]+'.');
                unblockUI()
            }
        });
    })

    $('#register_formm').submit((e) => {
        e.preventDefault();

        let form_data = new FormData(document.getElementById('register_formm'));
        blockUI("Verifying details, please wait...");
        $.ajax({
            url: "/register",
            type: 'POST',
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: () => {
                window.location.href = "/user/dashboard"
                unblockUI()
            },
            error: (data) => {
                showError('Error:', data.responseJSON.message);
                unblockUI()
            }
        });
    })

    $('#edit_userr').submit((e) => {
        e.preventDefault();

        let form_data = new FormData(document.getElementById('edit_userr'));
        blockUI("Updating details, please wait...");
        $.ajax({
            url: "/user",
            type: 'POST',
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: () => {
                showSuccess("Success:", "Details Updated")
                unblockUI()
            },
            error: (data) => {
                showError('Error:', data.responseJSON.message);
                unblockUI()
            }
        });
    })

    $('#edit_user_sec').submit((e) => {
        e.preventDefault();

        let form_data = new FormData(document.getElementById('edit_user_sec'));
        blockUI("Updating details, please wait...");
        $.ajax({
            url: "/auth/user",
            type: 'POST',
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: () => {
                showSuccess("Success:", "Details Updated");
                unblockUI()
            },
            error: (data) => {
                showError('Error:', data.responseJSON.message);
                unblockUI()
            }
        });
    })


    $('#add_to_cart').click((e) => {
        e.preventDefault();

        var dataId = $('input[name="bookId"]').val();

        let form_data = new FormData();

        form_data.set('qty', 1)
        form_data.set('format', $('#item-format').val())
        form_data.set('book_id', dataId)

        blockUI("Adding item, please wait...");
        $.ajax({
            url: `/cart`,
            type: 'POST',
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: () => {
                showSuccess("Success:", "Item Added to Cart");
                unblockUI()
            },
            error: (data) => {
                showError('Error:', data.responseJSON.message);
                unblockUI()
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

    $('#loginn_formm').submit((e) => {
        e.preventDefault();

        let form_data = new FormData(document.getElementById('loginn_formm'));
        blockUI("Verifying details, please wait...");
        $.ajax({
            url: "/overseer/login",
            type: 'POST',
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: () => {
                window.location.href = "/overseer/dashboard"
                unblockUI()
            },
            error: (data) => {
                showError('Error:', data.responseJSON.message.split('.')[0]+'.');
                unblockUI()
            }
        });
    })
})
