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
                    call_user_func_array(array($this->url_controller, $this->url_action), $this->url_params);
                 else                    
                    $this->url_controller->{$this->url_action}();
            }
            else 
            {
                if (strlen($this->url_action) == 0)                     
                    $this->url_controller->index();                
                else                
                    header('location: ' . URL . 'apperror');                
            }
        } 
        else 
            header('location: ' . URL . 'apperror');            
    }

    private function splitUrl()
    {
        if (isset($_GET['url'])){
            // split URL            
            $url = trim($_GET['url'], '/');
            
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            // Put URL parts into according properties
            $this->url_controller = isset($url[0]) ? $url[0] : null;
            $this->url_action = isset($url[1]) ? $url[1] : null;

            // Remove controller and action from the split URL
            unset($url[0], $url[1]);

            // Rebase array keys and store the URL params
            $this->url_params = array_values($url);

            // for debugging. uncomment this if you have problems with the URL
            // echo 'Controller: ' . $this->url_controller . '<br>';
            // echo 'Action: ' . $this->url_action . '<br>';
            // echo 'Parameters: ' . print_r($this->url_params, true) . '<br>';
        }
    }        
}


