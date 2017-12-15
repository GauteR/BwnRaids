// Site.js

$.noConflict();
jQuery(document).ready(function($) {
    'use strict';

    function submitForm(values, callback) {
        return $.post({
            url: '/ajax/submit',
            data: values,
            success: callback,
            dataType: "json"
        });
    }

    // Index
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
    $('div.site-index div.timeline-item').click(function(e) {
        e.preventDefault();
        var ev_id = $(this).attr('aria-eventid'),
            ch_id = $(this).attr('aria-charid'),
            rank = $(this).attr('aria-rankid'),
            isOngoing = $(this).attr('isOngoing');

        if (rank >= 6) {
            window.location.replace("/site/login");
        } else {
            if (rank > 2 && !isOngoing) {
                var d = $.dialog('#ongoing-dialog').dialog({
                    buttons: [{
                        text: 'OK',
                        click: function() {
                            $(this).dialog("close");
                        },
                        autoOpen: false
                    }]
                });
                d.show();
            } else {
                window.location.replace("/events/index?event_id=" + ev_id + "&char_id=" + ch_id);
            }
        }
    });

    // Events
});