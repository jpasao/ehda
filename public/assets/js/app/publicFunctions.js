$(document).ready(function(){
    // Manages active menu option 
    hightlightOption();
});

function hightlightOption(){
    $menuEntries = $('#mobile-menu ul li')
    
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