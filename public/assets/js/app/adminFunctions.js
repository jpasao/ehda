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
    showTableImage();
    deleteElement();
});

// Datatable loading
function loadTables(){
    var section = location.href;

    $.extend($.fn.dataTable.defaults, {
        language: spDatatable,
        columnDefs: [{ targets: [-1], orderable: false }]
    });

    if (section.includes('lista')){
        $('#list').DataTable();
    }
    // Notifications on saving images
    var notify = false;
    var notifyText;
    if (section.includes('imagenes/guardar/error1')){
        notifyText = 'No se ha guardado la imagen; su tamaño ha de ser inferior a 2Mb';
        notify = true;
    }
    if (section.includes('imagenes/guardar/error2')){
        notifyText = 'No se ha guardado el archivo; El archivo especificado ha de ser una imagen';
        notify = true;
    }
    if (notify){
        new Noty({
            type: 'info',            
            timeout: 4000,             
            layout: 'bottomRight',
            text: notifyText
        }).show();        
    }
}

// Event binding to show table images in modal
function showTableImage(){
    $('#ImageList').on('click', '.imageOpener', function (event) {
        var button = $(event.currentTarget);
        var imageName = button.data('name');
        var imageFile = button.data('filename');
    
        var $modal = $('#modalImg');
        $modal.find('.modal-title').text(imageName);
        $modal.find('.imgModal').attr({ src: imageFile, alt: imageName});        
    });    
}

// Event to confirm deletion
function deleteElement(){
    $('#TagList, #ImageList').on('click', '.deleteElement', function(event){

        var link = $(event.currentTarget);
        var apiRoute = link.data('api');
        var name = link.data('name');

        var $modal = $('#delModal');
        $modal.find('#elementId').text(name);
        $modal.find('#delButton').attr('href', apiRoute + link[0].id);
    });

}