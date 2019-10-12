'use strict';

// Format date object to dd/mm/yyyy format
function parseDate(date){
    return moment(date).format('DD/MM/YYYY');    
}

// Add hours to date object
Date.prototype.addHours = function(hours){
    var added = this;    
    return moment(added).add(hours, 'h').toDate();
}

// Format date object to yyyy-MM-ddThh:mm:ss:000Z
function parseEventDate(date){
    return moment(date).format('YYYY-MM-DD[T]HH:mm:ss[:000Z]')
}

// Add leading zeros if needed
function padLeft(string, pad){
    var strLength = string.toString().length;
    var res;
    if (strLength < pad){
        string = '0' + string;
        res = padLeft(string, pad);
    }
    else res = string;

    return res;
}

// Round date object and returns HH:mm format
function roundHour(dateObj){
    var res;
    var momentObj = new moment(dateObj);
    res = momentObj.round(15, 'm').format('HH:mm');      
    
    if (res == '00:00') res = '10:00';
    if (res == '19:30') res = '19:00';

    return res;
}

// Return most future date
function lastestDate(date1, date2){
    var res = date1;
    if (date2 > date1) res = date2;

    return res;
}

// Suggest hour for modal hour field
function suggestHour(cellDate){
    var res = cellDate;
    var today = moment().add(globalOffset, 'h').toDate();
    var passed24Hour = calendar.optionsManager.computed.validRange(today).start;
    res = lastestDate(passed24Hour, cellDate);

    return res;
}

// Save message options
function getMessage(result){
    var resultText, foreColor, backColor, barColor;

    switch (result.status){
        case 1:
            foreColor = '#155724';
            backColor = '#c7e7be';
            barColor = '#64a072';
            break;
        case 0:
            foreColor = '#856404';
            backColor = '#fff3cd';
            barColor = '#ffd03f';
            break;
        case -1:
            foreColor = '#721c24';
            backColor = '#d9727c';
            barColor = '#a06464';  
            break; 
        default:
            foreColor = '#721c24';
            backColor = '#d9727c';
            barColor = '#a06464';            
    }
    resultText = result.statusMsg || 'Ha ocurrido un error';

    var coreMessage = {
        text: resultText,
        showHideTransition: 'fade', 
        allowToastClose: false, 
        hideAfter: 5000, 
        stack: false, 
        position: 'bottom-right',     
        bgColor: backColor, 
        textColor: foreColor,
        textAlign: 'left',  
        loader: true,  
        loaderBg: barColor
    };
    return coreMessage;
}



