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
define('PAGE_ADMIN_HOME', 'admin/inicio');

define('PAGE_TAG_SAVE', 'etiquetas/guardar/');
define('PAGE_TAG_LIST', 'etiquetas/lista');
define('API_TAG_SAVE', 'etiquetas/save');
define('API_TAG_DEL', 'etiquetas/delete/');

define('PAGE_IMAGE_SAVE', 'imagenes/guardar/');
define('PAGE_IMAGE_LIST', 'imagenes/lista');
define('API_IMAGE_SAVE', 'imagenes/save');
define('API_IMAGE_DEL', 'imagenes/delete/');

define('PAGE_POST_SAVE', 'entradas/guardar/');
define('PAGE_POST_LIST', 'entradas/lista');
define('API_POST_SAVE', 'entradas/save');
define('API_POST_DEL', 'entradas/delete/');

define('PAGE_SPAREDATE_SAVE', 'diaslibres/guardar');
define('API_SPAREDATE_SAVE', 'diaslibres/save');

// Public routes
define('PAGE_APPOINTMENT', 'citas');