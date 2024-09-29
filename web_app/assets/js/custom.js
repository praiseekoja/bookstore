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
                window.location.reload();
            },
            error: (data) => {
                showError('Error:', data.responseJSON.message);
                unblockUI()
            }
        });
    })

    $('#forget_formm').submit((e) => {
        e.preventDefault();

        let form_data = new FormData(document.getElementById('forget_formm'));
        blockUI("Verifying details, please wait...");
        $.ajax({
            url: "/auth/find-user",
            type: 'POST',
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: () => {
                unblockUI()
                showSuccess("OTP sent to your email, check your inbox", '');
                window.location.href = "/auth/otp"
            },
            error: (data) => {
                showError('Error:', data.responseJSON.message.split('.')[0]+'.');
                unblockUI()
            }
        });
    })

    $('#otp_formm').submit((e) => {
        e.preventDefault();

        let form_data = new FormData(document.getElementById('otp_formm'));
        blockUI("Verifying OTP, please wait...");
        $.ajax({
            url: `/auth/verify/${form_data.get('otp')}`,
            type: 'GET',
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: () => {
                unblockUI()
                showSuccess("OTP verified!", '');
                window.location.href = "/auth/change-password"
            },
            error: (data) => {
                showError('Error:', data.responseJSON.message.split('.')[0]+'.');
                unblockUI()
            }
        });
    })


    $('#psw_formm').submit((e) => {
        e.preventDefault();

        let form_data = new FormData(document.getElementById('psw_formm'));
        blockUI("Updating details, please wait...");
        $.ajax({
            url: `/auth/change-password`,
            type: 'POST',
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: () => {
                unblockUI()
                showSuccess("Password Reset Successfully!!", '');
                window.location.href = "/user/dashboard"
            },
            error: (data) => {
                showError('Error:', data.responseJSON.message.split('.')[0]+'.');
                unblockUI()
            }
        });
    })


    function showInfo(title = null, message = '') {
        iziToast.info({
            title,
            message,
            position: 'center'
        });
    }

    function showSuccess(title = "Success", message = '') {
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
