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
    var startOffset = isNext ? -2 : -4;
    var endOffset = isNext ? 1 : -1;

    if (eventArray.length > 0){
        var startEventDate, endEventDate, event;
        
        nextHourEventArray = eventArray.map(event => {         
            startEventDate = new Date((event.range.end).addHours(startOffset)); 
            endEventDate = new Date((startEventDate).addHours(endOffset));            
            return {
                start: startEventDate,
                end: endEventDate,
                className: 'nextHour',
                allDay: false
            };
        });
    }
    
    return nextHourEventArray;
}

// Build event object and add to calendar
function addHourBlocks(gCalEvents){
    // Get array with events to add
    var nextHourEventArray = buildHourBlocks(gCalEvents.calendar.state.eventStore.instances, true);
    var prevHourEventArray = buildHourBlocks(gCalEvents.calendar.state.eventStore.instances, false);
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
        calendar.addEventSource(nextHourDataSource);      
        calendar.addEventSource(prevHourDataSource);           
        nextHourLoaded = true;                         
    }
}

// Get google calendar events and start next hour building process
function managePrevNextHours(isLoading){
    if (isLoading == false && nextHourLoaded == false){
        // Get Google calendar events
        var gCalEvents = calendar.getEventSourceById('gCalSource');
        // Create next hour blocks
        addHourBlocks(gCalEvents); 
        // Move center description for mobile views
        if ($(window).width() < 600) moveCenterDescription();
    } 
}

// Manages text for events
function renderTitle(info){    
    var $element = $(info.el);    
    var view = info.view.type;
    var hasClassName = info.event.classNames.length > 0;

    if (hasClassName){
       removeTitle($element, view);
    }
    else {
        addDefaultTitle($element, view);
    }
}

// Add default title to events 
function addDefaultTitle($element, view){
    var title = ' No disponible';
    var $existingElement;

    switch (view){
        case 'dayGridMonth':
            $element.find('span.fc-title').text(title);
            break;
        case 'timeGridWeek':
        case 'timeGridDay':
            $existingElement = $element.find('div.fc-time span').first();
            $existingElement.text($existingElement.text() + title);
            break;
        case 'listMonth':
            $element.find('td.fc-list-item-title a').first().text(title);            
            break;                                
    }
}

// Remove text for next hour events
function removeTitle($element, view){
    var $existingElement;

    switch (view){
        case 'dayGridMonth':
            $element.find('span.fc-time').text('');
            break;
        case 'timeGridWeek':
        case 'timeGridDay':
            $existingElement = $element.find('div.fc-time span').first();
            $existingElement.text('');
            break;
        case 'listMonth':
            $element.find('span.fc-event-dot').css('background-color', 'transparent');            
            $element.find('td.fc-list-item-time').text('');
            break;         
    }
}

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

