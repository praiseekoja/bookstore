jQuery(document).ready(($) => {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.incr').click(async (e) => {
        span = $(e.target).data('id');
        let current = parseInt($(`#${span}`).text());
        let qty = current + 1
        id = span.split('-')[1]
        $(`#${span}`).text(qty)

        let unit = $(`#unit-${id}`).text().split('₦')[1];
        let unitPrice = parseFloat(unit.replace(/,/g, ""));
        let st = unitPrice * qty
        let total = (st).toLocaleString(undefined, { maximumFractionDigits: 2 });

        let sub = $(`#subbTotal-${id}`).text().split('₦')[1] ?? $(`.subbTotal-${id}`).text().split('₦')[1]
        let subTotal = parseFloat(sub.replace(/,/g, ""));
        let grand = $(`#total-price`).text().split('₦')[1];
        let currentTotal = parseFloat(grand.replace(/,/g, ""));
        let ab = parseFloat(((currentTotal - subTotal) + st));
        let grandTotal = ab.toLocaleString(undefined, { maximumFractionDigits: 2 });


        $(`#subbTotal-${id}`).text(`₦${total}`)
        $(`#total-price`).text(`₦${grandTotal}`)
        $(`#sub-price`).text(`₦${grandTotal}`)

        form_data = new FormData();
        form_data.append('qty', qty);
        form_data.append('id', id);

        await update_qty(form_data);
    });

    $('.decr').on('click', async (e) => {
        span = $(e.target).data('id');
        let current = parseInt($(`#${span}`).text());
        let qty = current;
        if (current >= 2) {
            qty = current - 1;
        } else {
            return;
        }
        $(`#${span}`).text(qty)
        id = span.split('-')[1]

        let unit = $(`#unit-${id}`).text().split('₦')[1];
        let unitPrice = parseFloat(unit.replace(/,/g, ""));
        let st = unitPrice * qty
        let total = (st).toLocaleString(undefined, { maximumFractionDigits: 2 });

        let sub = $(`#subbTotal-${id}`).text().split('₦')[1] ?? $(`.subbTotal-${id}`).text().split('₦')[1];
        let subTotal = parseFloat(sub.replace(/,/g, ""));
        let grand = $(`#total-price`).text().split('₦')[1];
        let currentTotal = parseFloat(grand.replace(/,/g, ""));
        let ab = parseFloat(((currentTotal - subTotal) + st));
        let grandTotal = ab.toLocaleString(undefined, { maximumFractionDigits: 2 });

        $(`#subbTotal-${id}`).text(`₦${total}`)
        $(`#total-price`).text(`₦${grandTotal}`)
        $(`#sub-price`).text(`₦${grandTotal}`)

        form_data = new FormData();
        form_data.append('qty', qty);
        form_data.append('id', id);

        await update_qty(form_data);

    });


    $('.remove-item').click((e) => {
        let id = $(e.target).data('id')

        if (id == undefined)
            return;

        $.ajax({
            url: `/cart/${id}`,
            type: 'DELETE',
            contentType: false,
            cache: false,
            processData: false,
            success: () => {
                unblockUI();
                showSuccess('Item Removed!');
            },
            error: (data) => {
                unblockUI();
                showError('Error:', data.responseJSON.message);
            },
        });
    })

    const update_qty = async (form_data) => {
        form_data.append('_method', 'PATCH');
        $.ajax({
            url: `/cart`,
            type: 'POST',
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: () => {
                unblockUI();
                showSuccess('Cart Updated!!!');
            },
            error: (data) => {
                unblockUI();
                showError('Error:', data.responseJSON.message);
            },
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

})

function makePayment() {
    let form_data = new FormData(document.getElementById('order-form'));

    if(isNullOrWhitespace(form_data.get('email'))){
        showError('Enter your email address')
    }

    const modal = FlutterwaveCheckout({
        public_key: "FLWPUBK-92f171ec65717d6566e119a032d269c9-X",
        tx_ref: form_data.get('ref'),
        amount: $('#total-pr').val(),
        currency: "NGN",
        payment_options: "card, banktransfer, internetbanking, enaira, opay, ussd",
        redirect_url: "https://hiddenfactsbooks.com/order",
        meta: {
            consumer_id: form_data.get('userId'),
            consumer_mac: "",
        },
        customer: {
            email: form_data.get('email'),
            phone_number: form_data.get('phone'),
            name: `${form_data.get('first_name')} ${form_data.get('last_name')}`,
        },
        customizations: {
            title: "Hidden Facts Books",
        },
        callback: async function (payment) {
            await verifyTransaction(payment.id);
            modal.close();
        }
    });
}

const verifyTransaction = async (payment_id) =>{
    $.ajax({
        url: `/payment/${payment_id}`,
        type: 'GET',
        contentType: false,
        cache: false,
        processData: false,
        success: () => {
            unblockUI();
            showSuccess('Cart Updated!!!');
        },
        error: (data) => {
            unblockUI();
            showError('Error:', data.responseJSON.message);
        },
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

function isNullOrWhitespace(input) {
    return !input || input.trim().length === 0;
}
