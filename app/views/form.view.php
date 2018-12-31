<div class="container">
    <form id="articleForm" method="post" action="<?= $baseUrl; ?>" onsubmit="return false;">
        <div class="col-6">
            <div class="container">
                <div class="col-12">
                    <input id="articleTitle" name="title" type="text" placeholder="*Заголовок статьи">
                    <textarea id="articleText" name="content" placeholder="*Поле ввода текста статьи"></textarea>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="container">
                <div class="col-12 fio-group">
                    <input id="authorLastname" name="lastname" type="text" placeholder="*Фамилия">
                    <input id="authorFirstname" name="firstname" type="text" placeholder="*Имя">
                    <input id="authorMiddlename" name="middlename" type="text" placeholder="*Отчество">
                </div>
                <div class="col-12 text-center">
                    <select id="rubricSelect" name="rubric">
                        <option value="">---*Выберите рубрику---</option>
                        <?php foreach ($rubrics as $rubric) { ?>
                            <option value="<?= $rubric->getId(); ?>"><?= $rubric->getTitle(); ?></option>
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