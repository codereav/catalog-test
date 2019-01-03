<?php if (isset($rubrics) && $rubrics) { ?>
    <div class="container">
        <div class="col-sm-12">
            <h3 class="text-center">Список рубрик - ссылки/кнопки</h3>
            <ul id="rubricsLinks">
                <?php if (isset($rubricsUlHtml)) { ?>
                    <?php echo $rubricsUlHtml; ?>
                <?php } ?>
            </ul>
        </div>
    </div>
<?php } ?>