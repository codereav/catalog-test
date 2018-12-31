<div class="container">
    <div class="col-sm-12">
        <h3 class="text-center">Список рубрик - ссылки/кнопки</h3>
        <ul id="rubricsLinks">
            <?php foreach ($rubrics as $rubric) { ?>
                <li><a href="" onclick="return false;"
                       data-rubric_id="<?= $rubric->getId(); ?>"><?= $rubric->getTitle(); ?></a>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>