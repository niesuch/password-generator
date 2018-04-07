/**
 * Function used for character's validation
 * @returns {result}
 */
function validate() {
    var result = {status: false, msg: ""};
    var inputs = document.querySelectorAll("input[type='checkbox']");

    for (var i = 0; i < inputs.length; i++) {
        if (inputs[i].checked) {
            result.status = true;
            break;
        }
    }

    if (!result.status) {
        result.msg = "One of checkboxes should be check!"
    } else {
        result.msg = "Success!";
    }

    return result;
}

/**
 * Function used for form submit
 */
function submit() {
    var validator = validate();

    if (validator.status) {
        document.getElementById("form").submit();
    } else {
        alert(validator.msg);
    }
}