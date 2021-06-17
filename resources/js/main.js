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
            data: data
        });
    });
});
