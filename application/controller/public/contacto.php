<?php

class Contacto extends Controller
{
    private $operationName = 'contacto';
    public  function index()
    {
        ini_set('session.use_cookies', '0');
        // Load default views
        require_once APP . 'view/public/includes/header.php';
        require_once APP . 'view/public/includes/menu.php';
        require_once APP . 'view/public/contact/index.php';
        require_once APP . 'view/public/includes/footer.php';

        require_once APP . 'core/logger.php';  
        Logger::debug('Acceso a ' . $this->operationName, false);  
    }

    public function sendContactMail()
    {
        require APP . 'core/logger.php';  
        try 
        {  
            $valid = true;
            if (Utils::isAjax()){
                if (Utils::checkPostRequest() == false)
                {
                    Logger::debug('Petición no enviada con POST en ' . $this->operationName, true);
                    $valid = false;               
                }                          
                if (isset($_POST['save'])){
                    Logger::debug('Inicio de envío de email en ' . $this->operationName . '. Parámetros: ' . json_encode($_POST), true);
                    
                    $name = $_POST['name'];
                    $surname = $_POST['surname'];
                    $email = $_POST['email'];
                    $message = $_POST['message'];
                    $response = [];
                    
                    if (empty($_POST['gotcha']) == false)
                    {
                        Logger::debug('Intento de envío de correo por BOT en formulario de ' . $this->operationName, true);
                        $valid = false; 
                    }
                    
                    if ($valid)
                    {
                        $fullName = $name . ' ' . $surname;
                        $subject = 'Consulta de ' . $fullName .' desde el formulario de contacto de la web';     
                        $body = $fullName . ' escribió:<br/>' . $message;
                        $res = Utils::sendMail($email, $subject, $body, $this->operationName);
                        if ($res){
                            $response['status'] = 1;      
                            $response['statusMsg'] = 'Hemos recibido tu consulta. Te respondo a la mayor brevedad';
                        }
                        else {
                            $response['status'] = -1; 
                            $response['statusMsg'] = 'Ha ocurrido un problema al enviar la consulta, inténtalo más tarde.';                  
                        }
                        Logger::debug('Fin de envío de email en ' . $this->operationName, true);
                    }
                    echo json_encode($response);
                }
            }
        } 
        catch (Exception $e) 
        {
			Utils::redirectToErrorPage('envío de email en ' . $this->operationName, $e);
        }
    }
}