<?php

class Application
{
    private $url_controller = null;
    private $url_action = null;
    private $url_params = array();    
    private $adminArray = array(ADMIN, LOGIN, POST, TAG, IMAGE, SPAREDATE, CLOSEDATE, PAGE_ADMIN_ERROR);
    private $publicArray = array(HOME, APPOINTMENT, APPOINTMENT . '/add', PRICES, POSTS, CONTACT, PAGE_ERROR);
    private $isAdmin = null;
    private $isPublic = null;
    private $page = null;
    private $existController = null;

    public function __construct()
    {
        $this->splitUrl();
        $this->checkPage();

        // Check for controller: no controller given? then load start-page
        if ($this->existController == false) 
        {
            require_once APP . 'controller/public/inicio.php';
            $page = new Inicio();
            $page->index();
        } 
        else 
        {
            $controllerFolder = null;
            if ($this->isAdmin)
            {
                $controllerPath = ADMIN_FOLDER;
            }
            elseif ($this->isPublic)
            {
                $controllerPath = PUBLIC_FOLDER;
            }
            else
            {
                header('location: ' . $this->getErrorPage());
                return;
            }

            // Load controller
            require_once APP . 'controller/' . $controllerPath . $this->url_controller . '.php';
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
    }

    private function splitUrl()
    {
        $url = $this->getUrl();
        if (isset($url)){
            // split URL            
            $urlArray = trim($url, '/');
            
            $urlArray = filter_var($urlArray, FILTER_SANITIZE_URL);
            $urlArray = explode('/', $urlArray);

            // Put URL parts into according properties
            if (isset($urlArray[0]))
            {
                $this->url_controller = $urlArray[0];
                $this->existController = true;
            }
            else 
            {
                $this->url_controller = null;
                $this->existController = false;
            }
            
            $this->url_action = isset($urlArray[1]) ? $urlArray[1] : null;

            // Remove controller and action from the split URL
            unset($urlArray[0], $urlArray[1]);

            // Rebase array keys and store the URL params
            $this->url_params = array_values($urlArray);
        }
        else
        {
            $this->existController = false;
        }
    }  
    
    private function getErrorPage()
    {
        $errorPage = URL . PAGE_ERROR;
        $url = $this->getUrl();
        
        if (isset($url))
        {
            foreach ($this->adminArray as $adminRoute)
            {
                if (strpos($url, $adminRoute) !== false)
                {
                    if(!isset($_SESSION)) 
                    { 
                        session_start(); 
                    }                     
                    $errorPage = URL . PAGE_ADMIN_ERROR;
                    $_SESSION['adminerror'] = 'Se estaba visitando ' . $url;
                    break;
                }
            }
            unset($url);
        }

        return $errorPage;
    }

    private function checkPage()
    {
        $url = $this->getUrl();
        $found = null;
        if (isset($url))
        {
            foreach ($this->publicArray as $publicRoute)
            {
                if ($url === $publicRoute)
                {
                    $this->isPublic = true;
                    $this->page = $publicRoute;
                    break;
                }
            }
            if ($this->isPublic !== true)
            { 
                $url =  explode('/', $url)[0];
                foreach ($this->adminArray as $adminRoute)
                {
                    if ($url === $adminRoute)
                    {
                        $this->isAdmin = true;
                        $this->page = $adminRoute;
                        break;
                    }
                }
            }
        }
        unset($url);
        unset($found);
    }

    private function getUrl()
    {
        $res = null;

        if (isset($_GET) && isset($_GET['url']))
        {
            $res = $_GET['url'];
        }

        return $res;
    }
}


