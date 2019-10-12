<?php

class Citas extends Controller
{
    public function __construct()
    {
        // Load Google authentication
        require_once APP . 'core/authentication.php';
        require_once APP . 'core/utils.php';
    }
    
    public function index()
    {
        // Load views
        require_once APP . 'view/includes/header.php';
        require_once APP . 'view/home/index.php';
        require_once APP . 'view/includes/footer.php';
    }

    public function add()
    {
        if (Utils::isAjax())
        {
            $name = $_POST['name'];
            $date = $_POST['date'];
            $hour = $_POST['hour'];
            $contactInfo = $_POST['contactInfo'];
            $response = [];

            try 
            {
                // Authenticate service account
                $auth = new Authentication();
    
                // Format dates
                $start = new Google_Service_Calendar_EventDateTime();
        
                $startDateObj = Utils::BuildDate($date, $hour);
                $hourLater = date('H:i', strtotime($hour) + 60*60);
                $endDateObj = Utils::BuildDate($date, $hourLater);

                $dateStart = $startDateObj->format('Y-m-d');
                
                $dateEnd = $endDateObj->format('H:i:s');
                $end = new Google_Service_Calendar_EventDateTime();
      
                // Check events at same time or one hour later
                $nextHourLater = date('H:i', strtotime($hour) + 2*60*60);
                $nextHourLaterObj = Utils::BuildDate($date, $nextHourLater);
                $prevHour = date('H:i', strtotime($hour) - 60*60);
                $prevHourObj = Utils::BuildDate($date, $prevHour);
                $freeMoment = Utils::CheckEventExists($auth, $prevHourObj, $nextHourLaterObj);
                
                if ($freeMoment) 
                {
                    // Create new event
                    $auth->event = new Google_Service_Calendar_Event(array(
                        'summary' => 'Sesión',
                        'description' => $contactInfo,
                        'start' => array(
                            'dateTime' => $dateStart . 'T' . $hour . ':00',
                            'timeZone' => 'Europe/Madrid'
                        ),
                        'end' => array(
                            'dateTime' => $dateStart . 'T' . $dateEnd,
                            'timeZone' => 'Europe/Madrid'
                        )
                    ));
    
                    // Add new event to calendar
                    $auth->event = $auth->service->events->insert(CALENDARID, $auth->event);  
                    $response['status'] = 1;      
                    $response['statusMsg'] = 'La cita se ha guardado correctamente';
                }
                else 
                {
                    $response['status'] = 0; 
                    $response['statusMsg'] = 'Hay una cita cercana. Por favor, elija otro momento';                        
                }                
            }
            catch(Exception $e) 
            {      
                $response['status'] = -1; 
                $response['statusMsg'] = 'Ha ocurrido un error al guardar la cita: ' . $e->getMessage();                         
            }
            finally
            {
                echo json_encode($response);
            }
        }        
    }
}