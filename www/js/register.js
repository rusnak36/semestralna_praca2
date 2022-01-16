function send() {
    var email = $("#email");
    var username = $("#username");
    var psw = $("#psw");
    var pswRepeat = $("#pswRepeat");

    if(!(isNotEmpty(email) && isNotEmpty(username) && isNotEmpty(psw) && isNotEmpty(pswRepeat))) {
        return;
    }
    if(!validateEmail(email.val())) {
        return;
    }

    $.ajax({
        url: 'includes/register.inc.php',
        method: 'POST',
        dataType: 'text',
        data: {
            submit: 'submit',
            email: email.val(),
            username: username.val(),
            psw: psw.val(),
            pswRepeat: pswRepeat.val()
        }, success: function (response) {
            alert(response);
        }
    });
}

function isNotEmpty(caller) {
    if (caller.val() == '') {
        caller.css('border', '1px solid red');
        return false;
    } else
        caller.css('border', '');

    return true;
}
function validateEmail(email)
{
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}