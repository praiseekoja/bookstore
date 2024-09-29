jQuery(document).ready(($) => {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#login_formm').submit((e) => {
        e.preventDefault();

        let form_data = new FormData(document.getElementById('login_formm'));
        form_data.append('deviceId', getTracker())
        blockUI("Verifying details, please wait...");
        $.ajax({
            url: "/login",
            type: 'POST',
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: (data) => {
                console.log(data)
                if(data.status == 200){
                    window.location.href = "/user/dashboard"
                }else if(data.status == 201){
                    console.log(data.status)
                    window.location.href = "/auth/mfa/otp"
                }
                unblockUI()
            },
            error: (data) => {
                showError('Error:', data.responseJSON.message.split('.')[0] + '.');
                unblockUI()
            }
        });
    })

    $('#register_formm').submit((e) => {
        e.preventDefault();

        let form_data = new FormData(document.getElementById('register_formm'));
        form_data.append('deviceId', getTracker())
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
                showError('Error:', data.responseJSON.message.split('.')[0] + '.');
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
                showError('Error:', data.responseJSON.message.split('.')[0] + '.');
                unblockUI()
            }
        });
    })

    $('#device_otp_formm').submit((e) => {
        e.preventDefault();

        let form_data = new FormData(document.getElementById('device_otp_formm'));
        form_data.append('deviceId', getTracker())
        blockUI("Verifying OTP, please wait...");
        $.ajax({
            url: `/auth/device/verify/${form_data.get('otp')}`,
            type: 'POST',
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: () => {
                unblockUI()
                showSuccess("OTP verified!", '');
                window.location.href = "/user/dashboard"
            },
            error: (data) => {
                showError('Error:', data.responseJSON.message.split('.')[0] + '.');
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
                showError('Error:', data.responseJSON.message.split('.')[0] + '.');
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
                showError('Error:', data.responseJSON.message.split('.')[0] + '.');
                unblockUI()
            }
        });
    })

    // Function to get a cookie by name
    function getTracker() {
        let name = 'browser_tracker';
        let cookies = document.cookie.split(';');
        for (let i = 0; i < cookies.length; i++) {
            let cookie = cookies[i].trim();
            // Check if this cookie matches the requested name
            if (cookie.indexOf('browser_tracker=') == 0) {
                return cookie.substring(name.length + 1);
            }
        }
        return null; // Cookie not found
    }

    // Function to create a cookie
    function setCookie() {
        let expires = '';

        let date = new Date();
        date.setTime(date.getTime() + (730 * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();

        document.cookie = "browser_tracker=" + generateUUID() + expires + "; path=/";
    }

    // Check if cookie exists, if not, create a new one
    function checkOrCreateCookie() {
        let existingCookie = getTracker();
        if (!existingCookie) {
            setCookie();
        }
    }

    function generateUUID() {
        return ([1e7] + -1e3 + -4e3 + -8e3 + -1e11).replace(/[018]/g, c =>
            (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16)
        );
    }

    // Usage example
    checkOrCreateCookie(); // Creates a cookie if it doesn't exist, expires in 7 days

})
