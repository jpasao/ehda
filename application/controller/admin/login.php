<?php

class Login extends Controller
{
    public function index()
    {
        // Load view
        require_once APP . 'view/admin/login/index.php';
    }

    public function signin()
    {
        require_once APP . 'core/utils.php';  
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
                }            
                else 
                {
                    $user = $_POST['username'];
                    $pass = $_POST['password'];                  
                    
                    $userData = $this->modelLogin->GetUser($user);
                    $dbPass = $userData->password;

                    if (password_verify($pass, $dbPass))
                    {
                        $_SESSION['logged'] = TRUE;
                        $_SESSION['name'] = $user;
                        $response['status'] = 1;   
                    }
                    else
                    {
                        $response['status'] = 0; 
                        $response['statusMsg'] = 'Datos de autenticación incorrectos';                            
                    }
                }
            }
            catch(Exception $e)
            {
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