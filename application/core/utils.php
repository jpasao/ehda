<?php

class Utils
{   
    private static $secondsInHour = 60 * 60;
    private static $timeZone = 'Europe/Madrid';
    private static $adminArray = array(ADMIN, LOGIN, POST, TAG, IMAGE, SPAREDATE, CLOSEDATE, PAGE_ADMIN_ERROR);
    private static $publicArray = array(HOME, APPOINTMENT, PRICES, POSTS, CONTACT, PAGE_ERROR, LEGAL, PRIVACY, COOKIES);
    
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

    // Check event is at least within 24h
    public static function check24hoursBefore($date, $hour)
    {
        $appointmentDate = self::BuildDate($date, $hour);
        $now = new DateTime('now');

        $interval= $appointmentDate->diff($now, true);
        return (($interval->days * 24) + $interval->h) < 24;
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
    public static function buildEvent($auth, $eventSummary, $eventDescription, $dateStart, $hour, $dateEnd, $color, $atendeeEmail = NULL)
    { 
        try {
            $basicArray = array(
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
            );
    
            if (!empty($atendeeEmail))
            {
                $basicArray['attendees'] = array(array('email' => $atendeeEmail));
            }  
            $auth->event = new Google_Service_Calendar_Event($basicArray);
    
            // Add new event to calendar
            $auth->event = $auth->service->events->insert(CALENDARID, $auth->event); 
        } catch (Exception $e) {
            self::redirectToErrorPage('guardado de cita en el calendario', $e);
        }
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

    // Check page is admin or not
    public static function checkAdminPage()
    {
        $url = self::getUrl();
        $url =  explode('/', $url)[0];
        $page = array();
        $page['isPublic'] = false;
        $page['isAdmin'] = true;

        if (isset($url))
        {
            if ($url != 'assets') {
                foreach (self::$publicArray as $publicRoute)
                {
                    if ($url === $publicRoute)
                    {
                        $page['page'] = $publicRoute;
                        $page['isPublic'] = true;
                        $page['isAdmin'] = false;                    
                        break;
                    }
                }
                if ($page['isPublic'] !== true)
                {                 
                    foreach (self::$adminArray as $adminRoute)
                    {
                        if ($url === $adminRoute)
                        {
                            $page['isPublic'] = false;
                            $page['isAdmin'] = true;
                            $page['page'] = $adminRoute;
                            break;
                        }
                    }
                }
            }
        }
        unset($url);
        return $page;
    }

    private static function getUrl()
    {
        $res = null;

        if (isset($_GET) && isset($_GET['url']))
        {
            $res = $_GET['url'];
        }

        return $res;
    }    

    // Redirect to admin error page
    public function redirectToAdminErrorPage($errorMessage, $exception)
    {
        require_once APP . 'core/logger.php';

        $message = 'Excepción en ' . $errorMessage . ': ' . $exception->getMessage();
        Logger::error($message, true);
        $_SESSION['adminerror'] = $message;  
        header('location: ' . URL . PAGE_ADMIN_ERROR); 
    } 

    // Redirect to public error page
    public function redirectToErrorPage($errorMessage, $exception)
    {
        require_once APP . 'core/logger.php';

        $message = 'Excepción en ' . $errorMessage . ': ' . $exception->getMessage();
        Logger::error($message, false);            
        header('location: ' . URL . PAGE_ERROR); 
    } 

    public static function sendMail($email, $subject, $body, $page)
    {
        try {     
            // Validations
            $valid = true;
            $res = false;
  
            if (self::checkHeaderInjection(array($email, $subject, $body)) == true)
            {
                Logger::debug('Inyección en datos de cabecera en formulario de ' . $page, true);
                $valid = false; 
            }                              
            if (self::isValidEmail($email) == false)
            {
                Logger::debug('Email no válido en formulario de ' . $page, true);
                $valid = false;               
            }
            if (self::checkNewLine($body) == false)
            {
                Logger::debug('Mensaje con saltos de línea en formulario de ' . $page, true);
                $valid = false;               
            }     

            if ($valid)
            {
                $mail = new PHPMailer\PHPMailer\PHPMailer();
                $mail->isSMTP();
                $mail->SMTPDebug = PHPMailer\PHPMailer\SMTP::DEBUG_SERVER; //SMTP::DEBUG_OFF
                $mail->CharSet = 'UTF8';
                $mail->Encoding = 'quoted-printable';
                $mail->Host = HOST;
                $mail->Port = PORT;
                $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
                $mail->SMTPAuth = true;
                $mail->Username = USERADDRESS;
                $mail->Password = USERPASS;
                $mail->setFrom(USERADDRESS, USERNAME);
                $mail->addReplyTo(USERADDRESS, USERNAME);
                $mail->addAddress($email, 'Destinatario');
                $mail->Subject = $subject;
                $mail->msgHTML($body);
    
                if (!$mail->send()) {
                    Logger::debug('Error al enviar correo: ' . $mail->ErrorInfo , false);
                } 
                else {
                    Logger::debug('Correo enviado con éxito', false);
                    $res = true;
                }
            }
            
        } catch (Exception $e) {
            self::redirectToErrorPage('envío de email', $e);
        }
        return $res;
    }

    private static function isValidEmail($email) {
        return preg_match('#^[a-z0-9.!\#$%&\'*+-/=?^_`{|}~]+@([0-9.]+|([^\s]+\.+[a-z]{2,6}))$#si', $email);
    }

    private static function checkNewLine($string) {
        if (preg_match("/(%0A|%0D|\\n+|\\r+)/i", $string) != 0) {
            return false;
        }
        return true;
    }

    public static function checkPostRequest() {
        if ($_SERVER['REQUEST_METHOD'] != 'POST'){
            return false;
        }
        return true;
    }

    private static function checkHeaderInjection($fields) {
        $injection = false;
        for ($n = 0; $n < count($fields); $n++) {
            if (preg_match("/%0A/", $fields[$n]) || preg_match("/%0D/", $fields[$n]) || preg_match("/\r/", $fields[$n]) || preg_match("/\n/", $fields[$n])) {
                $injection = true;
            }
        }
        return $injection;
    }
}