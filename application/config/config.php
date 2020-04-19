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
define('IMG_DIR', ROOT . URL_PUBLIC_FOLDER . '/img/');
define('IMG_URL', URL . 'img/');

// Database
define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'dbehda');
define('DB_USER', 'invitado');
define('DB_PASS', 'invitado');
define('DB_CHARSET', 'utf8');	

// Google Calendar Api
define('SCOPE', 'https://www.googleapis.com/auth/calendar.events');
define('KEYLOCATION', APP . 'core/client_secret.json');
define('CLIENTID', '116098602185754580577');
define('EMAIL', 'ehda-calendar@ehda-204218.iam.gserviceaccount.com');
define('CALENDARID', 'trablete@gmail.com');
putenv('GOOGLE_APPLICATION_CREDENTIALS=' . KEYLOCATION);

// Admin routes
define('NEWNODE', 'nueva');
define('ADMIN', 'admin/');
define('PAGE_ADMIN_HOME', ADMIN . 'inicio');
define('PAGE_ADMIN_ERROR', 'appadminerror');

define('TAG', 'etiquetas/');
define('PAGE_TAG_SAVE', TAG . 'guardar/');
define('PAGE_TAG_LIST', TAG . 'lista');
define('API_TAG_SAVE', TAG . 'save');
define('API_TAG_DEL', TAG . 'delete/');

define('IMAGE', 'imagenes/');
define('PAGE_IMAGE_SAVE', IMAGE . 'guardar/');
define('PAGE_IMAGE_LIST', IMAGE . 'lista');
define('API_IMAGE_SAVE', IMAGE . 'save');
define('API_IMAGE_DEL', IMAGE . 'delete/');

define('POST', 'entradas/');
define('PAGE_POST_SAVE', POST . 'guardar/');
define('PAGE_POST_LIST', POST . 'lista');
define('API_POST_SAVE', POST . 'save');
define('API_POST_DEL', POST . 'delete/');

define('SPAREDATE', 'diaslibres/');
define('PAGE_SPAREDATE_SAVE', SPAREDATE . 'guardar');
define('API_SPAREDATE_SAVE', SPAREDATE . 'save');

// Public routes
define('PAGE_ERROR', 'apperror');
define('PAGE_APPOINTMENT', 'citas');