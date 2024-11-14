<?

add_filter('elementor/frontend/the_content', 'dom_modify',99);
add_filter('the_content', 'dom_modify',99);

function dom_modify($content){
    if (empty($content)) return $content;

    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'));
    libxml_clear_errors();

    $divs = $dom->getElementsByTagName('div');
    foreach ($divs as $div) {
        if ($div->hasAttribute('aria-label')) {
            $ariaLabel = $div->getAttribute('aria-label');

            foreach ($div->getElementsByTagName('a') as $a) {
                $a->setAttribute('aria-label', $ariaLabel);
            }

            foreach ($div->getElementsByTagName('button') as $a) {
                $a->setAttribute('aria-label', $ariaLabel);
            }
        }
    }

    return $dom->saveHTML($dom->getElementsByTagName('body')->item(0));
}
