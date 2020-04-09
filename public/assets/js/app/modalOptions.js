'use strict';

// Options
var $modal = $('#modal-form');
var $submit = $('#submit');
var $validation = $('#validation');
var hasErrors;
var errorMessage;
var $name = $('#name');
var $nameGroup = $('#nameGroup');
var $contactInfo = $('#contactInfo');
var $contactInfoGroup = $('#contactInfoGroup');
var $date;
var $hour = $('#hour');
var $hourGroup = $('#hourGroup');
var $duration = $('#duration');
var $citeForm = $('#citeForm');
var $modalTitle = $('#modalTitle');

// Initialize tooltips
$(function () { $('[data-toggle="tooltip"]').tooltip(); });

function showModal(info){ 
    var isAllDay = info.allDay;
    var viewName = info.view.type;
    var cellDate = info.date;

    // Avoid open modal for allday section
    if (isAllDay == true && viewName != 'dayGridMonth'){
        return false;
    }

    $('#name, #hour, #contactInfo')
        .val('')
        .parent()
        .removeClass('has-error');
    
    var dateParsed = parseDate(cellDate);
    $date = dateParsed;
    var todayParsed = parseDate(new Date());
    if (dateParsed == todayParsed) { dateParsed = 'Hoy ' + dateParsed; }
    
    $modalTitle.text('Añadir cita para ' + dateParsed);
    
    $validation
        .removeClass('alert-danger')
        .removeClass('alert-warning')
        .addClass('alert-info')
        .text('Nueva cita');

    var suggestedHourObj = suggestHour(cellDate);
    var suggestedHour = roundHour(suggestedHourObj);
    $hour.val(suggestedHour);

    $citeForm.removeClass('was-validated'); 
    $modal.modal('show');
}

function validateFormHasErrors(){
    hasErrors = false;
    errorMessage = '';

    $validation
        .removeClass('alert-danger')
        .removeClass('alert-warning')
        .addClass('alert-info')
        .text('Nueva cita');

    var fieldsArray = [$name, $hour, $contactInfo];
    var selector;
    var $group;
    var $control;

    $.each(fieldsArray, function(i, value){
        selector = '#' + value[0].id;
        $group = $(selector + 'Group');
        $control = $(selector);
        if ($control.val() == ''){
            switch(selector){
                case '#name': errorMessage += 'Debe indicar su nombre. '; break;
                case '#hour': errorMessage += 'Debe indicar la hora. '; break;
                case '#contactInfo': errorMessage += 'Es necesaria la información de contacto. '; break;
            };
            $group.addClass('has-danger');
            $control.addClass('form-control-danger');
            hasErrors = true;
        }
        else{
            $group.removeClass('has-danger');
            $control.removeClass('form-control-danger');
        }
    });

    if (hasErrors){
        $validation
            .addClass('alert-danger')
            .removeClass('alert-info')
            .text(errorMessage);   
        $submit.addClass('disabled');
    }
    else {
        $submit.removeClass('disabled');
    } 
    $citeForm.addClass('was-validated');   
}

// Check coincidence with other appointments and prev/next hours
function validateHour(){
    // Get ony gCalSource events, not hourBlocks
    var gCalEvents = calendar.getEvents().filter(event => event.id.length > 0);
    var attemptDate = moment($date + ' ' + $hour.val(), 'DD/MM/YYYY hh:mm').toDate();
    var attemptDateEnd = attemptDate.addHours($duration.val());
    var hourBefore, hourAfter;
    var isNearBegining, isNearEnd;
    
    // Search for coincidence
    var sameTime = gCalEvents.find(event => {  
        hourBefore = event.start.addHours(-1);
        hourAfter = event.end.addHours(1);

        isNearBegining = isWithinLimits(hourBefore, hourAfter, attemptDate);
        isNearEnd = isWithinLimits(hourBefore, hourAfter, attemptDateEnd);
        return isNearBegining || isNearEnd;
    });

    if (sameTime != undefined){   
        var nearFrom = moment(sameTime.start).format('HH:mm');
        var nearTo = moment(sameTime.end).format('HH:mm')
        $validation
            .addClass('alert-warning')
            .removeClass('alert-info')
            .text('Hay una cita muy cerca entre las ' + nearFrom + ' y las ' + nearTo + '. Por favor, elija otra hora');         
        $submit.addClass('disabled');
        hasErrors = true;
    }
    else {        
        $validation
            .addClass('alert-info')
            .removeClass('alert-warning')
            .text('Nueva cita');       
        $submit.removeClass('disabled');
        hasErrors = false;
    } 
}

// Check if an attempt hour is under certain period of time
function isWithinLimits(lowEnd, highEnd, attempt){
    return (attempt > lowEnd && attempt < highEnd);
}

function sendForm(){
    var params = {
        name: $name.val(),
        date: $date,
        hour: $hour.val(),
        duration: $duration.val(),
        contactInfo: $contactInfo.val()
    };
   
    post(params, addEventEndPoint)
        .always(function(result){        
            $modal.modal('hide'); 
              
            // Show message and reload calendar            
            $.toast(getMessage(result));                     
            calendar.refetchEvents(); 
            $submit.button('reset');         
        });
}

// Events
$hour.on('change', validateHour);

$submit.on('click', function(){
    validateFormHasErrors();
    if (hasErrors == false){
        validateHour();
    }
        
    if (hasErrors == false){
        var btn = $(this);
        btn.button('loading');
        sendForm();
    }
});

(function($) {
    $.fn.button = function(action) {
      if (action === 'loading' && this.data('loading-text')) {
        this.data('original-text', this.html()).html(this.data('loading-text')).prop('disabled', true);
      }
      if (action === 'reset' && this.data('original-text')) {
        this.html(this.data('original-text')).prop('disabled', false);
      }
    };
  }(jQuery));