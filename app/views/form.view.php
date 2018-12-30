<div class="container">
    <form id="articleForm" method="post" action="<?= $baseUrl; ?>" onsubmit="return false;">
        <div class="col-6">
            <div class="container">
                <div class="col-12">
                    <input id="articleTitle" name="articleTitle" type="text" placeholder="*Заголовок статьи">
                    <textarea id="articleText" name="articleText" placeholder="*Поле ввода текста статьи"></textarea>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="container">
                <div class="col-12 fio-group">
                    <input id="authorLastname" name="authorLastname" type="text" placeholder="*Фамилия">
                    <input id="authorFirstname" name="authorFirstname" type="text" placeholder="*Имя">
                    <input id="authorMiddlename" name="authorMiddlename" type="text" placeholder="*Отчество">
                </div>
                <div class="col-12 text-center">
                    <select id="rubricSelect" name="rubricSelect">
                        <option value="">---*Выберите рубрику---</option>
                        <?php foreach ($rubrics as $key => $rubric) { ?>
                            <option value="<?= $rubric['id']; ?>"><?= $rubric['title']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-12 text-center">
                    <button id="articleFormSubmit" style="display:none;">Опубликовать</button>
                </div>
            </div>
        </div>
    </form>
</div>