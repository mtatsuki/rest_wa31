$(function () {
    $('form').validate({
        rules: {
            id: {
                required: true
            },
            name: {
                required: true
            },
            gender: {
                required: true
            }
        },
        messages: {
            id: {
                required: "※必須項目です。",
            },
            name: {
                required: "※必須項目です。",
            },
            gender: {
                required: "※必須項目です。",
            },
        },
        errorPlacement: function (error, element) {
            if (element.attr("name") == "CheckboxGroup1[]") {
                error.insertAfter("#CheckboxGroup1_error");
            } else if (element.attr("name") == "gender") {
                error.insertAfter("#radio_error");
            } else {
                error.insertAfter(element);
            }
        },
    });
});