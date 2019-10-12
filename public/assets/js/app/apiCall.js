'use strict';

function post(params, url){

    var deferred = $.Deferred();

    var res = null;
    $.ajax({
        method: 'POST',
        url: encodeURI(url),
        dataType: 'json',
        data: params
    })
    .done(function(response){
        deferred.resolve(response);
    })
    .fail(function(error){
        deferred.reject(error);
    });  
    
    return deferred.promise();
}

