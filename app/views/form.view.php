<div class="container">
    <form id="articleForm" method="post" action="<?= $baseUrl; ?>" onsubmit="return false;">
        <div class="col-6">
            <div class="container">
                <div class="col-12">
                    <input id="articleTitle" name="title" type="text" placeholder="Заголовок статьи" required>
                    <textarea id="articleText" name="content" placeholder="Текст статьи" required></textarea>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="container">
                <div class="col-12 fio-group">
                    <input id="authorLastname" name="lastname" type="text" placeholder="Фамилия" required>
                    <input id="authorFirstname" name="firstname" type="text" placeholder="Имя" required>
                    <input id="authorMiddlename" name="middlename" type="text" placeholder="Отчество" required>
                </div>
                <div class="col-12 text-center">
                    <select id="rubricSelect" name="rubric" required>
                        <option value="">---Выберите рубрику---</option>
                        <?php foreach ($rubrics as $rubric) { ?>
                            <option value="<?= $rubric->getId(); ?>"><?= $rubric->getTitle(); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div id="form-errors" class="container">
                </div>
                <div class="col-12 text-center">
                    <button id="articleFormSubmit" style="display:none;">Опубликовать</button>
                </div>
            </div>
        </div>
    </form>
</div>