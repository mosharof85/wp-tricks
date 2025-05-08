<?php

add_shortcode('shipping_method_message', function (){
    ?>
    <p id="shipping-method-message"></p>
    <?php
});

add_action('wp_footer', function (){
    ?>
    <script>
        let loadCartValue = <?php echo WC()->cart->get_total('edit'); ?>;

        if(loadCartValue >=150){
            jQuery('#shipping-method-message').html('Kostenloser Versand');
        }
        else{
            jQuery('#shipping-method-message').html('Zzgl. Versandkosten in Höhe von 6,90€. Ab 150€ Versandkostenfrei.');
        }

        jQuery(document).ajaxComplete(function(event, xhr, settings) {
            const url = settings.url;
            const targets = ['wc-ajax=get_refreshed_fragments', 'wc-ajax=remove_from_cart'];
            const hasTarget = targets.some(substring => url.includes(substring));

            if (hasTarget){
                // console.log(Object.values(xhr.responseJSON.fragments)[2])
                // console.log(xhr.responseJSON.fragments);

                const parser = new DOMParser();
                const doc = parser.parseFromString(Object.values(xhr.responseJSON.fragments)[2], 'text/html');
                let cartValue = (doc.querySelector('.woocommerce-Price-amount.amount').innerText);
                cartValue = parseFloat(cartValue.replace(/\s*€/, '').replace(/\u00A0/g, '').replace(',', '.'))
                console.log(cartValue)
                if(cartValue >=150){
                    jQuery('#shipping-method-message').html('Kostenloser Versand');
                }
                else{
                    jQuery('#shipping-method-message').html('Zzgl. Versandkosten in Höhe von 6,90€. Ab 150€ Versandkostenfrei.');
                }

            }
        });
    </script>
    <?php
});
