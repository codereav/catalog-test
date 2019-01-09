jQuery(document).ready(function ($) {
    $.validator.addMethod("lettersonly", function (value, element) {
        return this.optional(element) || /^[a-z,а-я\s]+$/i.test(value);
    }, "Только буквы и пробелы!");

    $('#articleForm').validate({
        onclick: false,
        onblur: false,
        errorLabelContainer: '#form-errors',
        rules: {
            title: 'required',
            content: 'required',
            lastname: {required: true, lettersonly: true},
            firstname: {required: true, lettersonly: true},
            middlename: {required: true, lettersonly: true},
            rubric_id: 'required'
        },
        messages: {
            rubric_id: "Выберите рубрику!"
        },
        onkeyup: function (element) {
            validate($(element).closest('form'));
        }
    });

    $('#articleForm').submit(function (e) {
        e.preventDefault();
        if ($(this).validate().checkForm()) {
            $.ajax({
                url: baseUrl + '/article/add',
                type: 'POST',
                dataType: 'json',
                data: $(this).serialize(),
                success: function (data) {
                    if (data.errors.length > 0) {
                        $.each(data.errors, function (i, val) {
                            $('#form-errors').html('');
                            $('#form-errors').append('<div class="error">' + val + '</div>');
                        });
                        quicklyShow($('#form-errors'));
                    } else {
                        $('#articleForm').find('input[type=text], textarea, select').val('');
                        validate($('#articleForm'));
                        $('#form-success').html('');
                        $('#form-success').append('<div class="success">Статья успешно добавлена!</div>');
                        quicklyShow($('#form-success'));
                        if (data.html.length > 0 && data.rubric_id !== undefined && data.rubric_id === $('#rubricsLinks a.selected').data('rubric_id') ||
                            $('#rubricsLinks a.selected').length === 0) {
                            $('#articlesContainer').prepend(data.html);
                            $('html, body').animate({
                                scrollTop: $("#articlesListHeader").offset().top
                            }, 2000);
                        }
                    }
                }
            });
        }
    });

    $('#articleForm select').change(function () {
        validate($(this).closest('form'));
    });

    $('#rubricsLinks a').click(function (e) {
        e.preventDefault();
        $('#rubricsLinks a').removeClass('selected');
        $(this).addClass('selected');
        var rubricId = $(this).data('rubric_id');
        $.ajax({
            url: baseUrl + '/rubric/' + rubricId,
            type: 'POST',
            dataType: 'json',
            success: function (data) {
                if (data.errors.length > 0) {
                    $.each(data.errors, function (i, val) {
                        $('#form-errors').html('');
                        $('#form-errors').append('<div class="error">' + val + '</div>');
                    });
                    quicklyShow($('#form-errors'));
                } else {
                    $('#articlesList_rubricTitle').text(': ' + data.rubricTitle);
                    $('#articlesContainer').html('');
                    if (data.html.length > 0) {
                        $('#articlesContainer').replaceWith(data.html);
                        $('html, body').animate({
                            scrollTop: $("#articlesListHeader").offset().top
                        }, 2000);
                    }
                }
            }
        });
    });

    function validate(form) {
        if (event.key !== 'Tab') {
            if ($(form).validate().checkForm()) {
                $('#articleFormSubmit').show();
            } else {
                $('#articleFormSubmit').hide();
            }
        }
    }

    function quicklyShow(element) {
        $(element).slideDown();
        $(element).delay(5000);
        $(element).slideUp();
    }
});