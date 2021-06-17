$(function() {
    /**
     * Set body target
     * @type {*|jQuery|HTMLElement}
     */
    let body = $('body');

    /**
     * Set csrf token
     */
    let csrf = $('meta[name="csrf-token"]').attr('content');

    /**
     * Confirm deletion of elements, before submitting form.
     */
    body.on('submit', '.form-delete', function (e) {
        if (!confirm('Delete this item?')) {
            e.preventDefault();
        }
    })

    /**
     * Update status of a task, when ever the checkbox is changed.
     */
    body.on('change, blur', '.update-input', function () {
        if (!$(this).data('field').length || !$(this).data('route').length) {
            return;
        }

        let field = $(this).data('field'),
            route = $(this).data('route'),
            data = {'_token': csrf};

        if ($(this).is('input[type="checkbox"]')) {
            data[field] = $(this).is(':checked') ? 1 : 0;
        } else {
            data[field] = $(this).val();
        }

        $.ajax({
            method: 'PUT',
            url: route,
            data: data,
            dataType: 'json',
        }).done(function (data) {
            // I haven't added any smart way of showing flash messages, when
            // done with the ajax call.
        });
    });

    // To trigger then change, whenever a checkbox is checked, we need to fire blur.
    $('input[type="checkbox"].update-input').click(function () {
        $(this).blur();
    });

    /**
     * Flash messages
     */
    let flashMsg = $('.flash-msg'),
        timer;

    // Show message
    flashMsg.slideToggle('slow');

    // Auto hide message after 5 seconds
    timer = setTimeout(function () {
        flashMsg.slideToggle('slow');
    }, 5000);

    // Hide message when pressing close
    body.on('click', '.hide-flash-msg', function () {
        clearTimeout(timer);
        flashMsg.slideToggle('slow');
    });
});
