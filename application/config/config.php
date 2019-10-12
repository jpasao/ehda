<?php

define('ENVIRONMENT', 'development');

if (ENVIRONMENT == 'development' || ENVIRONMENT == 'dev') {
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
}

define('URL_PUBLIC_FOLDER', 'public');
define('URL_PROTOCOL', 'http://');
define('URL_DOMAIN', $_SERVER['HTTP_HOST']);
define('URL_SUB_FOLDER', str_replace(URL_PUBLIC_FOLDER, '', dirname($_SERVER['SCRIPT_NAME'])));
define('URL', URL_PROTOCOL . URL_DOMAIN . URL_SUB_FOLDER);	

define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'dbehda');
define('DB_USER', 'invitado');
define('DB_PASS', 'invitado');
define('DB_CHARSET', 'utf8');	

define('SCOPE', 'https://www.googleapis.com/auth/calendar.events');
define('KEYLOCATION', APP . 'core/client_secret.json');
define('CLIENTID', '116098602185754580577');
define('EMAIL', 'ehda-calendar@ehda-204218.iam.gserviceaccount.com');
define('CALENDARID', 'trablete@gmail.com');
putenv('GOOGLE_APPLICATION_CREDENTIALS=' . KEYLOCATION);