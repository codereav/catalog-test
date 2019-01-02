<div class="container">
    <a href="<?= $baseUrl; ?>">На главную</a>
    <?php if ($article) { ?>
        <h1><?= $article->getTitle(); ?></h1>
        <div class="container">
            <?= $article->getContent(); ?>
        </div>
        <div class="text-right"><?= $article->getAuthorName(); ?></div>
    <?php } else { ?>
      Статья не найдена!
    <?php } ?>
</div>