<?php

function custom_gtranslate_language_switcher_script() {
    ?>
    <style>
        [data-gt-lang="de"],
        [data-gt-lang="en"]{
            display: none;
        }
        .combined-language-switcher{
            padding: 0 20px;
        }
    </style>
    <script type="text/javascript">

        window.addEventListener('load', function (){
            console.log('Loaded')
            if(document.documentElement.lang === "en"){
                jQuery('[data-gt-lang="de"]').show();
                jQuery('[data-gt-lang="en"]').hide();
            }
            else{
                jQuery('[data-gt-lang="de"]').hide();
                jQuery('[data-gt-lang="en"]').show();
            }
        })
        

        const htmlElement = document.documentElement;
        // Create a MutationObserver instance
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.attributeName === 'lang') {
                    const newLang = htmlElement.getAttribute('lang');
                    if(newLang === 'en'){
                        jQuery('[data-gt-lang="de"]').show();
                        jQuery('[data-gt-lang="en"]').hide();
                    }
                    else{
                        jQuery('[data-gt-lang="de"]').hide();
                        jQuery('[data-gt-lang="en"]').show();
                    }
                }
            });
        });

        // Start observing the html element for lang attribute changes
        observer.observe(htmlElement, {
            attributes: true,
            attributeFilter: ['lang']
        });
    </script>
    <?php
}
add_action( 'wp_head', 'custom_gtranslate_language_switcher_script' );

function combined_language_switcher() {
    $english = do_shortcode('[gt-link lang="en" label="" widget_look="en"]');
    $german = do_shortcode('[gt-link lang="de" label="" widget_look="de"]');

    return '<div class="combined-language-switcher">' . $english . ' ' . $german . '</div>';
}
add_shortcode('combined_languages', 'combined_language_switcher');

function add_combined_language_switcher($items, $args) {
    if ( in_array($args->theme_location,['mobile_menu', 'primary']) ) {
        $switcher = do_shortcode('[combined_languages]');
        $items .= '<li class="menu-item language-switcher-menu-item">' . $switcher . '</li>';
    }
    return $items;
}
add_filter('wp_nav_menu_items', 'add_combined_language_switcher', 10, 2);
