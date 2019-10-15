'use strict';

$('#logout').on('click', function(){
    logout();
});

function logout(){
    post(null, logoutEndPoint)
        .always(function(){
            // Redirect to login page
            location.href = url + 'admin/login';
        });
}