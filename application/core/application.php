<?php

class Application
{
    private $url_controller = null;
    private $url_action = null;
    private $url_params = array();    
    private $isAdmin = null;
    private $isPublic = null;
    private $page = null;
    private $existController = null;

    public function __construct()
    {  
        require_once APP . 'core/utils.php';      
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
            if ($this->url_controller != 'assets'){
                require_once APP . 'controller/' . $controllerPath . $this->url_controller . '.php';
                $this->url_controller = new $this->url_controller();
            }

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
                    // Check for post slug
                    if ($this->page == POSTS)   
                    {
                        call_user_func_array(array($this->url_controller, 'searchSlug'), array($this->url_action));
                    }  
                    else 
                    {
                        header('location: ' . $this->getErrorPage());                
                    }               
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
            $this->checkPage();
            if ($this->isAdmin == true)
            {
                if(!isset($_SESSION)) 
                { 
                    session_start(); 
                }  
            
                $errorPage = URL . PAGE_ADMIN_ERROR;
                $_SESSION['adminerror'] = 'Se estaba visitando ' . $url;                          
            }
            unset($url);
        }

        return $errorPage;
    }

    private function checkPage()
    { 
        $page = Utils::checkAdminPage();
        $this->isPublic = $page['isPublic'];
        $this->isAdmin = $page['isAdmin'];
        $this->page = isset($page['page']) ? $page['page'] : null;
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


