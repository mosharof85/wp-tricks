jQuery(document).ajaxComplete(function(event, xhr, settings) {
                if(settings.data.includes('action=pld_post_undo_ajax_action') ||
                    settings.data.includes('action=pld_post_ajax_action')){
                    let response = (JSON.parse(xhr.responseText));

                    if(response.latest_count ===1){
                        document.querySelector('.pld-like-count-wrap.pld-count-wrap').classList.remove('disabled')
                        document.querySelector('.pld-like-wrap .fa.fa-heart-o').className = 'fas fa-heart'
                    }
                    if(response.latest_count ===0){
                        document.querySelector('.pld-like-count-wrap.pld-count-wrap').classList.add('disabled')
                        document.querySelector('.pld-like-wrap .fas.fa-heart').className = 'fa fa-heart-o'
                    }
                }
            });

    (function ($) {
        $(document).ajaxSend(function(event, xhr, settings) {
            if (settings.data && settings.data.indexOf("action=eael_ajax_post_search") !== -1) {
                settings.data += "&_nonce=" + encodeURIComponent(localize.nonce);
            }
        });
    })(jQuery);
