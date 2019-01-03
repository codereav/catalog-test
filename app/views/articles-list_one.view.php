<div id="articlesListOneBlock<?= $article->getId(); ?>" class="container articles-list-one-block">
    <h4><?= $article->getTitle(); ?></h4>
    <div class="text-right pull-right"><?= $article->getAuthorName(); ?></div>
    <div class="container">
        <?= $article->getContent(); ?>
    </div>
    <div class="container text-right">
        <a href="<?= $baseUrl . '/article/' . $article->getId(); ?>">
            <button>
                Читать >>>
    </div>
    </button>
    </a>
</div>