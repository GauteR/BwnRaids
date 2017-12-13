$.noConflict();
jQuery(document).ready(function($) {
    function submitForm(values, callback) {
        return $.post({
            url: '/ajax/submit',
            data: values,
            success: callback,
            dataType: "json"
        });
    }

    $('div.site-index a#not_attending_btn').click(function(e) {
        e.preventDefault();
        var form = $('form#quick-signup-form'),
            notif = $('div.site-index div#notif'),
            notif_text = $('div.site-index div#notif span#notif-text'),
            values = form.serializeArray();

        values.push({
            name: 'status_fk',
            value: "1"
        });

        values.push({
            name: 'source',
            value: 'quick-signup-form'
        });

        submitForm(values, function(response) {
            if (response.success) {
                notif_text.html("<p>Successfully added you as <strong>not available</strong> for the event.</p>");
                notif.removeClass('hidden');
            }
        });
    });
    $('div.site-index a#maybe_btn').click(function(e) {
        e.preventDefault();
        var form = $('form#quick-signup-form'),
            notif = $('div.site-index div#notif'),
            notif_text = $('div.site-index div#notif span#notif-text'),
            values = form.serializeArray();

        values.push({
            name: 'status_fk',
            value: "2"
        });

        values.push({
            name: 'source',
            value: 'quick-signup-form'
        });

        submitForm(values, function(response) {
            if (response.success) {
                notif_text.html("<p>Successfully added you as a <strong>maybe</strong> to the event.</p>");
                notif.removeClass('hidden');
            }
        });
    });
    $('div.site-index a#signup_btn').click(function(e) {
        e.preventDefault();
        var form = $('form#quick-signup-form'),
            notif = $('div.site-index div#notif'),
            notif_text = $('div.site-index div#notif span#notif-text'),
            values = form.serializeArray();

        values.push({
            name: 'status_fk',
            value: "3"
        });

        values.push({
            name: 'source',
            value: 'quick-signup-form'
        });

        submitForm(values, function(response) {
            if (response.success) {
                notif_text.html("<p>Successfully <strong>signed you up</strong> to the event.</p>");
                notif.removeClass('hidden');
            }
        });
    });
});