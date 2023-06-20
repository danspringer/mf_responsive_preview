<?php
if (rex::isBackend() && rex::getUser()) {
    rex_extension::register('STRUCTURE_CONTENT_SIDEBAR', ['responsive_preview','get'], rex_extension::LATE);
}
?>