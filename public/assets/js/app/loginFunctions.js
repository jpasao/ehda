'use strict';

var $submit = $('#submit');
var $user = $('#user');
var $pass = $('#pass');
var $errorMsg = $('#errorMsg');
var hasErrors;

function validateFormHasErrors(){
    hasErrors = false;
    var $userErr = $('#userErr');
    var $passErr = $('#passErr');

    if ($user.val() == '') {
        $userErr.show();
        hasErrors = true;
    }
    else {
        $userErr.hide();
    }
    if ($pass.val() == ''){
        $passErr.show();
        hasErrors = true;
    }
    else {
        $passErr.hide();
    }
}

function login(){
    var params = {
        username: $user.val(),
        password: $pass.val()
    };

    post(params, loginEndPoint)
        .always(function(result){
            if (result.status !== 1){
                // Show message
                $errorMsg.removeClass('hide').addClass('show');
                var message = result.statusMsg === undefined ? 'No se ha podido realizar el inicio de sesión' : result.statusMsg;
                $errorMsg.find('span').html(message);
            }
            else {
                // Redirect to admin page
                location.href = url + 'admin/inicio';
            }
        });
}

// Events
$submit.on('click', function(){
    validateFormHasErrors();
    if (hasErrors) {
        return;
    }
    else {
        login();
    }
});