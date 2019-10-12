<?php

class Utils
{    
    // Returns datetime in d/m/Y H:i format    
    public static function BuildDate($date, $hour)
    {
        return DateTime::createFromFormat(
            'd/m/Y H:i', 
            $date . ' ' . $hour, 
            new DateTimeZone('Europe/Madrid')
        );
    }

    // Returns current datetime in yyyymmdd format
    public static function BuildCurrentDate()
    {
        return date('YYYYmmdd');
    } 
    
    // Check events between dates and returns true if there exist events       
    public static function CheckEventExists($auth, $startDateObj, $endDateObj)
    {        
        $params = array(
            'timeMin' => $startDateObj->format('c'),
            'timeMax' => $endDateObj->format('c')
        );
        
        $results = $auth->service->events->listEvents(CALENDARID, $params);
        $events = $results->getItems();
        
        return (empty($events));
    }

    // Checks if request is AJAX like
    public static function isAjax()
    {
        // Check if request if Ajax type
        return  isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
                $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }    
}