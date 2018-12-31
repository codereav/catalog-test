jQuery(document).ready(function () {
    $('#articleForm').validate({
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
            console.log($(element).val());
            $(element).valid();
            if ($(element).closest('form').validate().checkForm()) {
                $('#articleFormSubmit').show();
            }
        }
    });
});