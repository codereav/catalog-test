<?php if (!$ajax) { ?>
    <h3 id="articlesListHeader" class="text-center">Список статей<span id="articlesList_rubricTitle"></span></h3>
<?php } ?>
<div class="articles-list" id="articlesContainer">
    <?php if (isset($articles) && $articles) { ?>
        <?php foreach ($articles as $article) {
            include 'articles-list_one.view.php';
        } ?>
        <?php if (isset($articles['children']) && !empty($articles['children'])) {
            foreach ($articles['children'] as $article) {
                include 'articles-list_one.view.php';
            }
        } ?>
    <?php } else { ?>
        <div class="container">Ничего не найдено!</div>
    <?php } ?>
</div>

