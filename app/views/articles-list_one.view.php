<div id="articlesListOneBlock<?= $article->getId(); ?>" class="container articles-list-one-block">
    <h4><?= $article->getTitle(); ?></h4>
    <div class="container">
        <?= $article->getContent(); ?>
    </div>
</div>