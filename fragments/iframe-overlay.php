<style>
    .responsive-preview-iframe-overlay {
        height: 100%;
        width: 0;
        position: fixed;
        z-index: 999999;
        top: 0;
        left: 0;
        background-color: rgb(0,0,0);
        background-color: rgba(0,0,0, 0.9);
        overflow-x: hidden;
        overflow-y: hidden;
    }

    .responsive-preview-iframe-overlay .close-btn {
        position: absolute;
        right: 45px;
        font-size: 35px;
        color: #fff;
    }

    .responsive-preview-iframe-overlay .article-title {
        position: absolute;
        right: 90px;
        font-size: 35px;
        color: #fff;
    }
    .opacity-1 {
        opacity: 1 !important;
    }
</style>

<?php
$article_id = $this->article_id;
$clang      = $this->clang;
$url        = $this->url;
$full_url   = rex_yrewrite::getFullUrlByArticleId($article_id,$clang)
?>

<div class="responsive-preview-iframe-overlay" id="responsive-overlay">
    <!--<h2 class="article-title"><?= rex_article::get($article_id)->getName() ?></h2>-->
    <a href="javascript:void(0)" class="close-btn" onclick="closePreview()">&times;</a>
    <iframe
        data-src="../assets/addons/mf_responsive_preview/vendor/previewer/index.php?article_id=<?= $article_id ?>&clang=<?= $clang ?>&url=<?= $full_url ?>"
        width="100%"
        height="100%"
    style="border: none;">
    </iframe>
</div>