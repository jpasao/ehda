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

// Manages sections folding and subsection highlight 
$(document).ready(function(){
    var contentId = $('div.content-inner').prop('id');
    var $subSection = $('#subSection' + contentId);

    // Highlight current subsection
    $subSection.addClass('active');
    // Unfold current section
    var $section = $subSection.parents().eq(2).find('a[data-toggle="collapse"]');
    $section.removeClass('collapsed').attr('aria-expanded', true); 
    $section.next().addClass('show');

    loadTables();
});

// Datatable loading
function loadTables(){
    var section = location.href;

    $.extend($.fn.dataTable.defaults, {
        language: spDatatable,
        columnDefs: [{ targets: [-1], orderable: false }]
    });

    if (section.includes('etiquetas')){
        $('#tags').DataTable();
    }
}