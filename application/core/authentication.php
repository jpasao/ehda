<?php

class Authentication
{
    private $scope = null;
    private $keyLocation = null;
    private $email = null;
    public $credentials = null;
    public $client = null;
    public $service = null;
    public $event =  null;

    public function __construct()
    {
        $this->scope = SCOPE;
        $this->keyLocation = KEYLOCATION;
        $this->email = EMAIL;
        
        $this->setAuth();
    }

    private function setAuth()
    {
        $this->client = new Google_Client();
        
        $this->client->setApplicationName('EHDA Calendar');

        $this->client->setScopes($this->scope);

        $this->client->useApplicationDefaultCredentials();

        $this->service = new Google_Service_Calendar($this->client);       
    }
}