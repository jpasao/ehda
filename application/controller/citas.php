<?php

class Citas extends Controller
{
    public function __construct()
    {
        // Load Google authentication
        require_once APP . 'core/authentication.php';
        require_once APP . 'core/utils.php';
        // If not logged, exit
        Utils::checkSession();        
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
            $duration = $_POST['duration'];
            $contactInfo = $_POST['contactInfo'];
            $eventTitle = 'Sesión';
            $response = [];

            try 
            {
                // Authenticate service account
                $auth = new Authentication();

                // Begin date        
                $dateStart = Utils::buildStartDate($date, $hour);

                // End date
                $dateEnd = Utils::buildEndDate($date, $hour, $duration);  

                // Previous hour
                $prevHourObj = Utils::buildPrevHour($date, $hour); 

                // Next hour
                $nextHourObj = Utils::buildNextHour($date, $hour, $duration);                
    
                $freeMoment = Utils::CheckEventExists($prevHourObj, $nextHourObj, $auth);
                
                if ($freeMoment) 
                {
                    // Create new event
                    Utils::buildEvent($auth, $eventTitle, $contactInfo, $dateStart, $hour, $dateEnd, '9');
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