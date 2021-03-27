<?php

class Diaslibres extends Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load Google authentication
        require_once APP . 'core/authentication.php';
        require_once APP . 'core/utils.php';
        Utils::checkSession();
    }

    public function guardar()
    {    
        try 
        {            
            $userName = $_SESSION['name']; 
            require_once APP . 'view/admin/includes/header.php';
            require_once APP . 'view/admin/includes/sideMenu.php';
            require_once APP . 'view/admin/calendar/addBusyDays.php';
            require_once APP . 'view/admin/includes/footer.php';        
        } 
        catch (Exception $e) 
        {
			Utils::redirectToAdminErrorPage('carga del guardado de días libres', $e);             
        }
    }

    public function save()
    {
        if (isset($_POST['save']) && isset($_POST['fromDate']) && !empty($_POST['fromDate']))
        {
            $fromDate = $_POST['fromDate'];
            $fromTime = $_POST['fromTime'];
            $toDate = $_POST['toDate'];
            $toTime = $_POST['toTime'];             
            $isFreeMoment;
            $isWorkingTime;
            $isEndDate;
            $dateFrom;
            $timeFrom;
            $timeStampIncreased;
            $endDate = Utils::BuildDate($toDate, $toTime);
            $currentDate = new DateTime();
            $eventMessage = 'Evento creado el ' . date('d/m/Y') . ' a las ' . date_format($currentDate->add(new DateInterval('PT2H')), 'H:i');
            $eventTitle = 'Tiempo libre';

            try 
            {
                // Authenticate service account
                $auth = new Authentication();
                
                $dateFrom = $fromDate;
                $timeFrom = $fromTime;
                $timeStampIncreased = Utils::IncreaseDate($dateFrom, $timeFrom, -2);
                do {
                    $isWorkingTime = $this->checkWorkingTime($timeStampIncreased);
                    if ($isWorkingTime)
                    {
                        // Previous hour
                        $prevHourObj = Utils::buildPrevHour($dateFrom, $timeFrom); 

                        // Next hour
                        $nextHourObj = Utils::buildNextHour($dateFrom, $timeFrom, 1);     

                        $isFreeMoment = Utils::CheckEventExists($prevHourObj, $nextHourObj, $auth);
                        // Create event on limits, working time and free hour
                        if ($isFreeMoment)
                        {
                            // Begin date        
                            $dateStart = Utils::buildStartDate($dateFrom, $timeFrom);

                            // End date
                            $dateEnd = Utils::buildEndDate($dateFrom, $timeFrom, 1);    

                            // Create spare time google calendar event 
                            Utils::buildEvent($auth, $eventTitle, $eventMessage, $dateStart, $timeFrom, $dateEnd, '7');
                        }
                    }
                    // Increase 2 hours to check next event
                    $timeStampIncreased = Utils::IncreaseDate($dateFrom, $timeFrom, 2);
                    $dateFrom = $timeStampIncreased->format('d/m/Y');
                    $timeFrom = $timeStampIncreased->format('H:i');

                    $isEndDate = $this->isEndDateReached($timeStampIncreased, $endDate);
    
                } while ($isEndDate == false);

                header('location: ' . URL . PAGE_SPAREDATE_SAVE);
            }             
            catch(Exception $e) 
            {  
                Utils::redirectToAdminErrorPage('guardado de días libres', $e);
            }           
        }
        else 
        {
            header('location: ' . URL . PAGE_SPAREDATE_SAVE);
        }
    }

    private function isEndDateReached($attemptDate, $endDate)
    {
        try 
        {            
            // Check if event about to save is within time limits
            return $attemptDate >= $endDate;
        } 
        catch (Exception $e) 
        {
			Utils::redirectToAdminErrorPage('comprobación de final de días libres', $e);
        }
    }

    private function checkWorkingTime($attemptDate)
    {
        try 
        {            
            // Check if event about to create is within working hours (10 to 19) or weekend
            $hour = date('G', $attemptDate->format('U'));
            $dayOfWeek = date('N', $attemptDate->format('U'));
            return ($hour > 8 && $hour < 20) && $dayOfWeek < 6;
        } 
        catch (Exception $e) 
        {
			Utils::redirectToAdminErrorPage('comprobación de horas laborables en días libres', $e);
        }
    }
}