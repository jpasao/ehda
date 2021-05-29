'use strict';

var nextHourLoaded = false;

// Get min date for valid range
function getMinValidDate(nowDate){    
    var res;

    var firstAttempt = new Date((nowDate).addHours(24));
    var hourAfter19 = moment(firstAttempt).hour() >= 19;
    // If after 19, return next day at 10:00
    if (hourAfter19){
        res = moment(firstAttempt).add(1, 'd').hour(10).minute(0).second(0).toDate();
    }
    else {
        res = firstAttempt;
    }

    return res;
}

// Build array of events
function buildHourBlocks(eventObj, isNext){
    var nextHourEventArray = [];
    // Convert object to array
    var eventArray = Object.entries(eventObj).map(arr => arr[1]);
    
    if (eventArray.length > 0){
        var startEventDate, endEventDate, duration, startOffset, endOffset;
        
        nextHourEventArray = eventArray.map(event => {   
            // Initial forbidden hours dates
            startOffset = -globalOffset - 1;
            endOffset = -globalOffset;   
            // Forbidden hour after an event            
            if (isNext){
                duration = (event.range.end - event.range.start) / (1000 * 60 * 60);
                startOffset = endOffset + duration;
                endOffset = startOffset + 1;
            }
            // Set event dates to google calendar object  
            startEventDate = new Date((event.range.start).addHours(startOffset)); 
            endEventDate = new Date(startEventDate).addHours(1);                        
            return {
                start: startEventDate,
                end: endEventDate,
                className: 'forbiddenHours',
                allDay: false
            };
        });
    }
    
    return nextHourEventArray;
}

// Build event object and add to calendar
function addHourBlocks(gCalEvents){
    // Get array with events to add
    var events = gCalEvents.context.eventStore.instances;
    var nextHourEventArray = buildHourBlocks(events, true) || [];
    var prevHourEventArray = buildHourBlocks(events, false) || [];
    // Add them to calendar and refresh view
    if (nextHourEventArray.length > 0){   
        var nextHourDataSource = {
            events: nextHourEventArray,            
            id: 'nextHourSource'
        };
        var prevHourDataSource = {
            events: prevHourEventArray,            
            id: 'prevHourSource'
        };        
        nextHourLoaded = true;                         
        calendar.addEventSource(nextHourDataSource);      
        calendar.addEventSource(prevHourDataSource);           
    }
}

// Get google calendar events and start next hour building process
function managePrevNextHours(isLoading){
    if (isLoading == false && nextHourLoaded == false){
        setTimeout(function(){
            // Get Google calendar events
            var gCalEvents = calendar.getEventSourceById('gCalSource');
            // Create next hour blocks
            addHourBlocks(gCalEvents); 
            // Move center description for mobile views
            if ($(window).width() < 600) moveCenterDescription();
        }, 500);
    } 
}

function setEventTitle(arg){
    var res = 'No Disponible';
    var eventClass = arg.event.classNames;
    if (eventClass.length > 0 && eventClass[0] == 'forbiddenHours'){
        res = '';
    }
    return res;
}

// Manages text for events
// function renderTitle(info){    
//     var $element = $(info.el);    
//     var view = info.view.type;
//     var hasClassName = info.event.classNames.length > 0;

//     if (hasClassName){
//        removeTitle($element, view);
//     }
//     else {
//         addDefaultTitle($element, view);
//     }
// }

// // Add default title to events 
// function addDefaultTitle($element, view){
//     var title = ' No disponible';
//     var $existingElement;

//     switch (view){
//         case 'dayGridMonth':
//             $element.find('span.fc-title').text(title);
//             break;
//         case 'timeGridWeek':
//         case 'timeGridDay':
//             $existingElement = $element.find('div.fc-time span').first();
//             $existingElement.text($existingElement.text() + title);
//             break;
//         case 'listMonth':
//             $element.find('td.fc-list-item-title a').first().text(title);            
//             break;                                
//     }
// }

// // Remove text for next hour events
// function removeTitle($element, view){
//     var $existingElement;

//     switch (view){
//         case 'dayGridMonth':
//             $element.find('span.fc-time').text('');
//             break;
//         case 'timeGridWeek':
//         case 'timeGridDay':
//             $existingElement = $element.find('div.fc-time span').first();
//             $existingElement.text('');
//             break;
//         case 'listMonth':
//             $element.find('span.fc-event-dot').css('background-color', 'transparent');            
//             $element.find('td.fc-list-item-time').text('');
//             break;         
//     }
// }

// Manages to open link events in new tab
function openInNewTab(info){
    var eventObj = info.event;

    if (eventObj.url){
        window.open(eventObj.url);
        info.jsEvent.preventDefault();
    }
}

// Move center description for mobile views
function moveCenterDescription(){
    var $centerDescription = $('#appointmentCal div.fc-center h2');
    var $calendar = $('#appointmentCal');  
    var $descCopy = $centerDescription.clone();
    $descCopy.prependTo($calendar);
    $centerDescription.empty();    

    // If new text appears, move to new location
    var target = $('#appointmentCal div.fc-center h2')[0];
    var observer = new MutationObserver(function(mutations) {
        var $description = $('#appointmentCal div.fc-center h2');
        var $headerText = $('#appointmentCal h2');
         var $descCopy = $description.clone();

        if ($descCopy.text() != ''){                      
            $headerText.empty();
            $descCopy.prependTo($calendar);
            $description.empty(); 
        }
    });
    
    var config = { attributes: false, childList: true, characterData: false };
    observer.observe(target, config);
}

