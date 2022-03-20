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
    loadDateRangePicker();
    loadDatePicker();
    setSpareDates();
    setCloseDates();
    generateSlug();
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

// Date range picker loader
function loadDateRangePicker(){
    $('#datetime').daterangepicker({
        "timePicker": true,
        "timePicker24Hour": true,
        "timePickerIncrement": 30,   
        "autoApply": true,   
        "linkedCalendars": false,  
        "locale": setLocaleDateRange(),        
        "startDate": new Date(),
        "endDate": new Date().addDays(7),
        "opens": "center",
        "buttonClasses": "btn btn-lg btn-square",
        "applyButtonClasses": "btn-gradient-05",
        "cancelClass": "btn-shadow"
    });       
}

// Date picker loader
function loadDatePicker(){
    $('#closedatetime').daterangepicker({
        "timePicker": true,
        "timePicker24Hour": true,
        "timePickerIncrement": 30,   
        "autoApply": true,   
        "linkedCalendars": false,  
        "locale": setLocaleDateRange(),        
        "startDate": new Date(),
        "singleDatePicker": true,
        "opens": "center",
        "buttonClasses": "btn btn-lg btn-square",
        "applyButtonClasses": "btn-gradient-05",
        "cancelClass": "btn-shadow"
    });     
}

// Event to pass spare dates to disabled fields
function setSpareDates(){ 
    $('#datetime').on('hide.daterangepicker', function(ev, picker){
        // Get times from daterangepicker object
        var fromDate = parseDate(picker.startDate);
        var fromTime = parseTime(picker.startDate);
        var toDate = parseDate(picker.endDate);
        var toTime = parseTime(picker.endDate);
        // Set times on disabled fields
        $('#fromDate').val(fromDate);
        $('#fromTime').val(fromTime);
        $('#toDate').val(toDate);
        $('#toTime').val(toTime);
    });
    $('#datetime').on('cancel.daterangepicker', function(ev, picker){
        // Reset disabled fields
        $('#fromDate').val('');
        $('#fromTime').val('');
        $('#toDate').val('');
        $('#toTime').val('');
        $(this).val('');
    });    
}

// Event to pass close dates to disabled fields
function setCloseDates(){
    $('#closedatetime').on('hide.daterangepicker', function(ev, picker){
        // Get times from daterangepicker object
        var fromDate = parseDate(picker.startDate);
        var fromTime = parseTime(picker.startDate);
        // Set times on disabled fields
        $('#closeDate').val(fromDate);
        $('#closeTime').val(fromTime);
    });
    $('#closedatetime').on('cancel.daterangepicker', function(ev, picker){
        // Reset disabled fields
        $('#closeDate').val('');
        $('#closeTime').val('');
        $(this).val('');
    });      
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

// Event to create post title's slug
function generateSlug(){
    var $postTitle = $('#title');
    var $slug = $('#slug');

    $postTitle.on('keyup', function(){
        $slug.val(this.value.hyphenify());
    });
}

String.prototype.slugify = function (separator = "-") {
    return this
        .toString()
        .normalize('NFD')                   // split an accented letter in the base letter and the acent
        .replace(/[\u0300-\u036f]/g, '')   // remove all previously split accents
        .toLowerCase()
        .trim()
        .replace(/[^a-z0-9 ]/g, '')   // remove all chars not letters, numbers and spaces (to be replaced)
        .replace(/\s+/g, separator);
};  

String.prototype.hyphenify = function (separator = "-") {
    return this
        .toString()
        .toLowerCase()
        .trim()
        .replace(/\s+/g, separator);
}; 