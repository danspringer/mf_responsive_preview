<?php

class responsive_preview
{
    public static function get($ep)
    {
        $subject = $ep->getSubject();
        $iframe_overlay = new rex_fragment();
        $title = rex_i18n::msg('mf_responsive_preview_title');
        $text = <<<HTML
                    <span
                    style="cursor:pointer"
                    onclick="openPreview()">
                    <i class="rex-icon fa fa-mobile"></i> $title
                    </span>
                    <script>
                    function openPreview() {
                        let overlay = $('#responsive-overlay');
                        let iframe = $('#responsive-overlay iframe');
                        iframe.attr('src', iframe.data('src'));
                        $('.rex-main-sidebar').addClass('opacity-1');
                        overlay.css('width', '100%');
                    }
                    
                    function closePreview() {
                      let overlay = $('#responsive-overlay');
                      let iframe = $('#responsive-overlay iframe');
                       overlay.css('width', '0');
                       iframe.attr('src', '');
                       $('.rex-main-sidebar').removeClass('opacity-1');
                    }
                    $(document).keyup(function(e) {
                         if (e.key === "Escape") { // escape key maps to keycode `27`
                           closePreview();
                        }
                    });
                    </script>
                    </p>
                HTML;
        $iframe_overlay->setVar('article_id',$ep->getParam('article_id'));
        $iframe_overlay->setVar('clang',$ep->getParam('clang'));
        $iframe_overlay->setVar('url', rex_getUrl($ep->getParam('article_id'), $ep->getParam('clang')));
        $text .= $iframe_overlay->parse('iframe-overlay.php');

        $fragment = new rex_fragment();
        $fragment->setVar('title', rex_i18n::msg('mf_responsive_preview_title'), false);
        $fragment->setVar('body', $text, false);
        $fragment->setVar('collapse', false); // das Feld erhält eine Akkordeon-Funktion
        #$fragment->setVar('collapsed', true); // das Feld ist erstmal zusammengeklappt, bei false ist es ausgeklappt
        $content = $fragment->parse('core/page/section.php');
        return preg_replace('~</section>~','</section>'.$content,$subject,1);
    }
}
