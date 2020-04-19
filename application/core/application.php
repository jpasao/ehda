<?php

class Application
{
    private $url_controller = null;
    private $url_action = null;
    private $url_params = array();    

    public function __construct()
    {
        $this->splitUrl();

        // Check for controller: no controller given? then load start-page
        if (!$this->url_controller) 
        {
            require_once APP . 'controller/citas.php';
            $page = new Citas();
            $page->index();
        } 
        elseif (file_exists(APP . 'controller/' . $this->url_controller . '.php')) 
        {
            require_once APP . 'controller/' . $this->url_controller . '.php';
            $this->url_controller = new $this->url_controller();

            if (method_exists($this->url_controller, $this->url_action)) 
            {
                if (!empty($this->url_params))    
                {
                    call_user_func_array(array($this->url_controller, $this->url_action), $this->url_params);
                }            
                else 
                {
                    $this->url_controller->{$this->url_action}();
                }                    
            }
            else 
            {
                if (strlen($this->url_action) == 0)               
                {
                    $this->url_controller->index();                
                }      
                else
                {
                    header('location: ' . $this->getErrorPage());                
                }                
            }
        } 
        else 
        {
            header('location: ' . $this->getErrorPage());            
        }
    }

    private function splitUrl()
    {
        $url = $_GET['url'];
        if (isset($url)){
            // split URL            
            $urlArray = trim($url, '/');
            
            $urlArray = filter_var($urlArray, FILTER_SANITIZE_URL);
            $urlArray = explode('/', $urlArray);

            // Put URL parts into according properties
            $this->url_controller = isset($urlArray[0]) ? $urlArray[0] : null;
            $this->url_action = isset($urlArray[1]) ? $urlArray[1] : null;

            // Remove controller and action from the split URL
            unset($urlArray[0], $urlArray[1]);

            // Rebase array keys and store the URL params
            $this->url_params = array_values($urlArray);
        }
    }  
    
    private function getErrorPage()
    {
        $errorPage = URL . PAGE_ERROR;
        $url = $_GET['url'];
        $adminArray = array(ADMIN, POST, TAG, IMAGE, SPAREDATE);
        foreach ($adminArray as $adminRoute)
        {
            if (strpos($url, $adminRoute) !== false)
            {
                $errorPage = URL . PAGE_ADMIN_ERROR;
                $_SESSION['adminerror'] = 'Se estaba visitando ' . $url;
                break;
            }
        }

        return $errorPage;
    }
}


