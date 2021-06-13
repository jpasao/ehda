'use strict';

$(document).ready(function(){
    // Manages active menu option 
    hightlightOption();
    // Bind events
    setEvents();
});

function hightlightOption(){
    var $menuEntries = $('#mobile-menu ul li')
    
    // Remove active class
    $menuEntries.find('a').removeClass('current');

    // Add class to current   
    var pages = ['/inicio', '/citas', '/precios', '/articulos', '/contacto'];
    var currentPage = pages
        .find(page => window.location.pathname.includes(page));

    if (currentPage != null){
        currentPage = currentPage.slice(1);
        $menuEntries.find('#' + currentPage).addClass('current');
    }    
}

function setEvents(){
    $('#formsend').on('click', sendContactForm);
}

function sendContactForm(){
    var fields = ['name', 'surname', 'email', 'message', 'gotcha'];
    var params = { save: true };
    fields.forEach(element => { params[element] = $('#' + element).val() });

    post(params, sendContactMail)
        .always(function(result){
            $.toast(getMessage(result)); 
        });
}