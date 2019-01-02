jQuery(document).ready(function ($) {
    $('#articleForm').validate({
        onclick: false,
        onblur: false,
        errorLabelContainer: '#form-errors',
        rules: {
            title: 'required',
            content: 'required',
            lastname: 'required',
            firstname: 'required',
            middlename: 'required',
            rubric: 'required'
        },
        messages: {
            rubric: "Выберите рубрику!"
        },
        onkeyup: function (element) {
            validate(element);
        }
    });

    $('#articleForm select').change(function () {
        validate(this);
    });

    function validate(element) {
        if (event.key !== 'Tab') {
            $(element).valid();
            if ($(element).closest('form').validate().checkForm()) {
                $('#articleFormSubmit').show();
            } else {
                $('#articleFormSubmit').hide();
            }
        }
    }
});