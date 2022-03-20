'use strict';

var calendar;

$(function(){
    if (window.location.href.includes('/citas')){
        var calendarEl = $('#appointmentCal')[0];
        var minDate = getMinValidDate(new Date());
    
        calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            themeSystem: 'bootstrap',
            googleCalendarApiKey: calApiKey,
            events: {
                url: calSource,
                googleCalendarId: calId,
                id: 'gCalSource'
            },
            eventContent: setEventTitle,
            allDaySlot: false,
            weekends: false,
            slotMinTime: '10:00:00',
            slotMaxTime: '20:00:00',
            validRange: function(nowDate){            
                return { start: minDate };
            },        
            headerToolbar:{
                start: 'today prev,next',
                center: 'title',
                end: 'dayGridMonth,timeGridWeek,timeGridDay listMonth'
            },
            locale: 'es', 
            slotLabelFormat:{
                hour: '2-digit',
                minute: '2-digit'
            },
            eventClick: openInNewTab,
            dateClick: showModal,
            loading: managePrevNextHours,
            viewDidMount: managePrevNextHours           
        });
        calendar.render();
    }
});