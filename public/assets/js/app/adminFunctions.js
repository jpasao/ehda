//'use strict';

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
    newPost();
});

// Datatable loading
function loadTables(){
    var section = location.href;
    
    if (section.includes('lista')){
        $.extend($.fn.dataTable.defaults, {
            language: spDatatable,
            columnDefs: [{ targets: [-1], orderable: false }]
        });
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
    $('#TagList, #ImageList, #PostList').on('click', '.deleteElement', function(event){

        var link = $(event.currentTarget);
        var apiRoute = link.data('api');
        var name = link.data('name');

        var $modal = $('#delModal');
        $modal.find('#elementId').text(name);
        $modal.find('#delButton').attr('href', apiRoute + link[0].id);
    });
}

// Event to load editor and events related to new post
function newPost(){
    var section = location.href;

    if (section.includes('entradas')){
        ClassicEditor
            .create(document.querySelector('#bodyTag'),{
                language: 'es',               
                alignment: {
                    options: [ 'left', 'right', 'center', 'justify' ]
                },
                toolbar: 
                     ['heading','|','bold','italic','link','bulletedList','numberedList','blockQuote','undo','redo','insertTable']                
                ,                               
                table: {
                    contentToolbar: [ 'tableColumn', 'tableRow', 'mergeTableCells' ]
                }                   
            })
            .catch( error => {
                console.error(error);
            });     
            
        // Load bootstrap combos      
        $('select').selectpicker();

        // Attach image preview on selecting
        $('#imageSelect').on('change', function(){
            var imagePath = this.selectedOptions[0].dataset.image;
            var $image = $('#imagePreview');
            $image.prop('src', imagePath);
        });
    }
}