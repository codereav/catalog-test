jQuery(document).ready(function () {
    $("#articleForm").validate();
    $( "#articleTitle" ).rules( "add", {
        minlength: 3
    });
    $("#articleText").rules( "add", {
        minlength: 3
    });
});