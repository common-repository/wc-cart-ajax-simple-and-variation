jQuery(document).ready(function ($) {
    'use strict';

    $("form.cart").submit(function (e) {
        var $form = $(this);

        var $thisbutton = $form.find("button[type=submit]");

        if ($thisbutton.is('.single_add_to_cart_button')) {

            var formData = $form.serializeArray().reduce(function (obj, item) {
                obj[item.name] = item.value;
                return obj;
            }, {});


            var data = {};
            data['quantity'] = formData['quantity'];
            if (!$form.is('.variations_form')) {
                data['product_id'] = $thisbutton.val();
            } else {
                data['product_id'] = formData['variation_id'];
            }

            if (typeof data['product_id'] == 'undefined' || typeof data['quantity'] == 'undefined') {
                return;
            }

            e.preventDefault();

            $thisbutton.removeClass('added');
            $thisbutton.addClass('loading');

            // Allow 3rd parties to validate and quit early.
            if (false === $(document.body).triggerHandler('should_send_ajax_request.adding_to_cart', [$thisbutton])) {
                $(document.body).trigger('ajax_request_not_sent.adding_to_cart', [false, false, $thisbutton]);
                return true;
            }

            // Trigger event.
            $(document.body).trigger('adding_to_cart', [$thisbutton, data]);

            $.ajax({
                type: 'POST',
                url: wc_add_to_cart_params.wc_ajax_url.toString().replace('%%endpoint%%', 'add_to_cart'),
                data: data,
                success: function (response) {
                    if (!response) {
                        return;
                    }

                    if (response.error && response.product_url) {
                        window.location = response.product_url;
                        return;
                    }

                    // Redirect to cart option
                    if (wc_add_to_cart_params.cart_redirect_after_add === 'yes') {
                        window.location = wc_add_to_cart_params.cart_url;
                        return;
                    }

                    // Trigger event so themes can refresh other areas.
                    $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $thisbutton]);
                },
                dataType: 'json'
            });
        }
    });
}); //END Document.ready