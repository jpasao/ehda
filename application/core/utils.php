<?php

class Utils
{   
    private static $secondsInHour = 60 * 60;
    private static $timeZone = 'Europe/Madrid';
    
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
        return date('Ymd');
    } 

    // Return datetime object increased
    public static function IncreaseDate($date, $time, $hours)
    {
        $datetime = self::BuildDate($date, $time);
        return ($hours > 0) ? 
            $datetime->add(new DateInterval('PT' . $hours . 'H')) :
            $datetime->sub(new DateInterval('PT' . $hours * -1 . 'H'));
    }
    
    // Check events between dates and returns true if there exist events
    public static function CheckEventExists($prevHourObj, $nextHourObj, $auth)
    {    
        // Build array
        $params = array(
            'timeMin' => $prevHourObj->format('c'),
            'timeMax' => $nextHourObj->format('c')
        );
        // Get event array 
        $results = $auth->service->events->listEvents(CALENDARID, $params);
        $events = $results->getItems();
        
        return (empty($events));                
    }

    // Build calendar event start date
    public static function buildStartDate($date, $hour)
    {        
        $startDateObj = self::BuildDate($date, $hour);
        return $startDateObj->format('Y-m-d');
    }

    // Build calendar event end date
    public static function buildEndDate($date, $hour, $duration)
    {       
        $eventEnd = strtotime($hour) + ($duration * self::$secondsInHour);
        $endHour = date('H:i', $eventEnd);
        $endDateObj = self::BuildDate($date, $endHour);      
        return $endDateObj->format('H:i:s');       
    }

    // Build calendar event previous hour
    public static function buildPrevHour($date, $hour)
    {
        $prevHour = date('H:i', strtotime($hour) - self::$secondsInHour);
        return self::BuildDate($date, $prevHour);
    }

    // Build calendar event next hour
    public static function buildNextHour($date, $hour, $duration)
    {
        $nextHour = date('H:i', strtotime($hour) + 2 * ($duration * self::$secondsInHour));
        return self::BuildDate($date, $nextHour);         
    }

    // Build calendar event
    public static function buildEvent($auth, $eventSummary, $eventDescription, $dateStart, $hour, $dateEnd, $color)
    {        
        $auth->event = new Google_Service_Calendar_Event(array(
            'summary' => $eventSummary,
            'description' => $eventDescription,
            'start' => array(
                'dateTime' => $dateStart . 'T' . $hour . ':00',
                'timeZone' => self::$timeZone
            ),
            'end' => array(
                'dateTime' => $dateStart . 'T' . $dateEnd,
                'timeZone' => self::$timeZone
            ),
            'colorId' => $color
        ));

        // Add new event to calendar
        $auth->event = $auth->service->events->insert(CALENDARID, $auth->event); 
    }

    // Checks if request is AJAX like
    public static function isAjax()
    {
        // Check if request if Ajax type
        return  isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
                $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }  
    
    // Check session is active
    public static function checkSession()
    {
        if(!isset($_SESSION)) 
        { 
            session_start(); 
        }         
        
        $logged = $_SESSION['logged'];
        $isLogged = isset($logged) && $logged = TRUE;

        if ($isLogged == false)
        {
            header('location: ' . URL . 'login');
            exit();
        }        
    } 

    // Redirect to admin error page
    public function redirectToAdminErrorPage($errorMessage, $exception)
    {
        $_SESSION['adminerror'] = 'Excepción en ' . $errorMessage . ': ' . $exception->getMessage();  
        header('location: ' . URL . PAGE_ADMIN_ERROR); 
    } 
}