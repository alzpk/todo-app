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
    body.on('click', '.update-task-status', function () {
        let isDone = $(this).is(':checked') ? 1 : 0,
            route = $(this).data('route');

        $.ajax({
            method: 'PUT',
            url: route,
            data: {
                '_token': csrf,
                'is_done': isDone
            }
        });
    });
});
