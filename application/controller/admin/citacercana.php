<?php

class Citacercana extends Controller
{
    private $operationName = 'cita cercana';
    public function __construct()
    {
        parent::__construct();
        // Load Google authentication
        require_once APP . 'core/authentication.php';
        require_once APP . 'core/utils.php';
        require APP . 'core/logger.php';
        Utils::checkSession();
    }

    public function guardar()
    {    
        try 
        {            
            Logger::debug('Acceso a ' . $this->operationName, true);                 
            $userName = $_SESSION['name']; 
            require_once APP . 'view/admin/includes/header.php';
            require_once APP . 'view/admin/includes/sideMenu.php';
            require_once APP . 'view/admin/calendar/addCloseAppointment.php';
            require_once APP . 'view/admin/includes/footer.php'; 
        } 
        catch (Exception $e) 
        {
			Utils::redirectToAdminErrorPage('carga del guardado de ' . $this->operationName, $e);             
        }
    }

    public function save()
    {
        // This appointment will not be validated against Calendar
        if (isset($_POST['save']) && 
            isset($_POST['closeDate']) && !empty($_POST['closeDate']) &&
            isset($_POST['closeTime']) && !empty($_POST['closeTime']) &&
            isset($_POST['duration']) && !empty($_POST['duration'])&&
            isset($_POST['email']) && !empty($_POST['email']) &&
            isset($_POST['name']) && !empty($_POST['name']))
        {
            $fromDate = $_POST['closeDate'];
            $fromTime = $_POST['closeTime'];
            $duration = $_POST['duration'];
            $email = $_POST['email']; 
            $name = $_POST['name'];             
            $eventMessage = 'Cita para ' . $name . ' el ' . $fromDate . ' a las ' . $fromTime;
            $eventTitle = 'Sesión Psicología';

            try 
            {
                Logger::debug('Inicio de guardado de ' . $this->operationName . '. Parámetros: ' . json_encode($_POST), true);
                // Authenticate service account
                $auth = new Authentication();

                // Begin date        
                $dateStart = Utils::buildStartDate($fromDate, $fromTime);

                // End date
                $dateEnd = Utils::buildEndDate($fromDate, $fromTime, $duration);  

                // Previous hour
                $prevHourObj = Utils::buildPrevHour($fromDate, $fromTime); 

                // Next hour
                $nextHourObj = Utils::buildNextHour($fromDate, $fromTime, $duration);                
    
                // Create new event
                Utils::buildEvent($auth, $eventTitle, $eventMessage, $dateStart, $fromTime, $dateEnd, '9', $email);
                
                Logger::debug('Fin de guardado de ' . $this->operationName, true);
                header('location: ' . URL . PAGE_CLOSEDATE_SAVE);
            }             
            catch(Exception $e) 
            {                  
                Utils::redirectToAdminErrorPage('guardado de ' . $this->operationName, $e);
            }           
        }
        else 
        {
            Logger::error('Faltan parámetros para guardado de ' . $this->operationName, true);
            header('location: ' . URL . PAGE_CLOSEDATE_SAVE);
        }
    }
}