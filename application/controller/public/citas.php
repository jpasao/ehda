<?php

class Citas extends Controller
{
    private $operationName = 'petición de cita';
    public function __construct()
    {
        // Load Google authentication
        require_once APP . 'core/authentication.php';
        require_once APP . 'core/utils.php';       
        require_once APP . 'core/logger.php';
    }

    public function index()
    {
        Logger::debug('Acceso a ' . $this->operationName, false);  
        // Load views
        require_once APP . 'view/public/includes/header.php';
        require_once APP . 'view/public/calendar/index.php';
        require_once APP . 'view/public/includes/footer.php';
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
                Logger::debug('Inicio de guardado de ' . $this->operationName . '. Parámetros: ' . json_encode($_POST), true);
                
                // Check too late request
                $tooLate = Utils::check24hoursBefore($date, $hour);

                if ($tooLate == false)
                {
                    // Begin date        
                    $dateStart = Utils::buildStartDate($date, $hour);
                    
                    // End date
                    $dateEnd = Utils::buildEndDate($date, $hour, $duration);  
                    
                    // Previous hour
                    $prevHourObj = Utils::buildPrevHour($date, $hour); 
                    
                    // Next hour
                    $nextHourObj = Utils::buildNextHour($date, $hour, $duration);                
                    
                    // Authenticate service account
                    $auth = new Authentication();
                    $freeMoment = Utils::CheckEventExists($prevHourObj, $nextHourObj, $auth);
                    
                    if ($freeMoment) 
                    {
                        // Create new event
                        Utils::buildEvent($auth, $eventTitle, $contactInfo, $dateStart, $hour, $dateEnd, '9');
                        $response['status'] = 1;      
                        $response['statusMsg'] = 'La cita se ha guardado correctamente';
                        Logger::debug('Fin de guardado de ' . $this->operationName . '. Cita guardada correctamente', true);
                    }
                    else 
                    {
                        $response['status'] = 0; 
                        $response['statusMsg'] = 'Hay una cita cercana. Por favor, elija otro momento';        
                        Logger::debug('Fin de guardado de ' . $this->operationName . '. Existe una cita cercana', true);                
                    }    
                }
                else 
                {
                    $response['status'] = 0; 
                    $response['statusMsg'] = 'La cita debe pedirse con al menos 24 horas de antelación';        
                    Logger::debug('Fin de guardado de ' . $this->operationName . '. La cita tiene menos de 24 horas de antelación', true);  
                }

            }
            catch(Exception $e) 
            {      
                $response['status'] = -1; 
                $response['statusMsg'] = 'Ha ocurrido un error al guardar la cita: ' . $e->getMessage();      
                Logger::debug('Error en guardado de ' . $this->operationName . ': ' . $e->getMessage(), true);                   
            }
            finally
            {
                echo json_encode($response);
            }
        }        
    }
}