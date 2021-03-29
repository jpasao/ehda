<?php

class Login extends Controller
{
    private $operationName = 'entrada';

    public function index()
    {
        // Load view
        require_once APP . 'view/admin/login/index.php';     
        require APP . 'core/logger.php';        
    }

    public function signin()
    {
        require_once APP . 'core/utils.php';  
        require APP . 'core/logger.php';
        if(!isset($_SESSION)) 
        { 
            session_start(); 
        } 

        if (Utils::isAjax())
        {
            $response = [];
            try 
            {
                if (!isset($_POST['username'], $_POST['password'])) 
                {
                    // Could not get the data that should have been sent.
                    $response['status'] = 0; 
                    $response['statusMsg'] = 'Debe completar todos los datos del formulario';          
                    Logger:error('Error en ' . $this->operationName . '. No se proporcionaron todos los datos');                   
                }            
                else 
                {
                    Logger::debug('Inicio de ' . $this->operationName . '. Parámetros: ' . json_encode($_POST), true);
                    $user = $_POST['username'];
                    $pass = $_POST['password'];                  
                    
                    $userData = $this->modelLogin->GetUser($user);
                    $dbPass = $userData->password;

                    if (password_verify($pass, $dbPass))
                    {
                        $_SESSION['logged'] = TRUE;
                        $_SESSION['name'] = $user;
                        $response['status'] = 1;   
                        Logger::debug('Fin de ' . $this->operationName, true);
                    }
                    else
                    {
                        Logger::error('Fin de ' . $this->operationName . '. Datos de autenticación incorrectos', true);
                        $response['status'] = 0; 
                        $response['statusMsg'] = 'Datos de autenticación incorrectos';                            
                    }
                }
            }
            catch(Exception $e)
            {
                Logger::error('Fin de ' . $this->operationName . '. Ha ocurrido un error al obtener los datos del usuario: ' . $e->getMessage(), true);
                $response['status'] = -1; 
                $response['statusMsg'] = 'Ha ocurrido un error al obtener los datos del usuario: ' . $e->getMessage();                         
            }
            finally
            {                 
                echo json_encode($response);                                              
            }
        }
    }

    public function signout()
    {
        try 
        {      
            require APP . 'core/logger.php';       
            Logger::debug('Acceso a logout', true);          
            session_start();
            unset($_SESSION['logged']);
            unset($_SESSION['name']);
            header('location: ' . URL . 'login');
        } 
        catch (Exception $e) 
        {
			Utils::redirectToAdminErrorPage('cerrar sesión', $e);
        }
    }
}