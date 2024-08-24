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

    function getCookie(name) {
        var re = new RegExp(name + "=([^;]+)");
        var value = re.exec(document.cookie);
        return (value != null) ? unescape(value[1]) : null;
    }
});
