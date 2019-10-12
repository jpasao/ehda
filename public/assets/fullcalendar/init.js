'use strict';

var calendar;

$(function(){

    var calendarEl = $('#appointmentCal')[0];
    var minDate = getMinValidDate(new Date());

    calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: [ 
            'interaction',
            'bootstrap', 
            'dayGrid', 
            'timeGrid',
            'googleCalendar',
            'list'
        ],
        googleCalendarApiKey: calApiKey,      
        events: { 
            url: calSource,
            id: 'gCalSource'
        },
        weekends: false,
        allDaySlot: false,
        minTime: '10:00:00',
        maxTime: '20:00:00',     
        validRange: function(nowDate){            
            return { start: minDate };
        },   
        eventTimeFormat: { 
            hour: '2-digit',
            minute: '2-digit'
        },               
        header: {
            left: 'today prev,next',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay, listMonth'
        },        
        locale: 'es',     
        //themeSystem: 'bootstrap',   
        eventRender: renderTitle,
        eventClick: openInNewTab,
        dateClick: showModal,
        loading: managePrevNextHours 
    }); 
    calendar.render(); 
});