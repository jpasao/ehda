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
define('ADMIN_FOLDER', 'admin/');
define('ADMIN', 'admin');
define('LOGIN', 'login');
define('PAGE_ADMIN_LOGIN', ADMIN_FOLDER . LOGIN . '/');
define('PAGE_ADMIN_HOME', ADMIN_FOLDER . 'inicio');
define('PAGE_ADMIN_ERROR', 'appadminerror');

$pageSaveNode = '/guardar/';
$pageListNode = '/lista';
$apiSaveNode = '/save';
$apiDeleteNode = '/delete';

define('TAG', 'etiquetas');
define('PAGE_TAG_SAVE', TAG . $pageSaveNode);
define('PAGE_TAG_LIST', TAG . $pageListNode);
define('API_TAG_SAVE', TAG . $apiSaveNode);
define('API_TAG_DEL', TAG . $apiDeleteNode);

define('IMAGE', 'imagenes');
define('PAGE_IMAGE_SAVE', IMAGE . $pageSaveNode);
define('PAGE_IMAGE_LIST', IMAGE . $pageListNode);
define('API_IMAGE_SAVE', IMAGE . $apiSaveNode);
define('API_IMAGE_DEL', IMAGE . $apiDeleteNode);

define('POST', 'entradas');
define('PAGE_POST_SAVE', POST . $pageSaveNode);
define('PAGE_POST_LIST', POST . $pageListNode);
define('API_POST_SAVE', POST . $apiSaveNode);
define('API_POST_DEL', POST . $apiDeleteNode);

define('SPAREDATE', 'diaslibres');
define('PAGE_SPAREDATE_SAVE', SPAREDATE . $pageSaveNode);
define('API_SPAREDATE_SAVE', SPAREDATE . $apiSaveNode);

define('CLOSEDATE', 'citacercana');
define('PAGE_CLOSEDATE_SAVE', CLOSEDATE . $pageSaveNode);
define('API_CLOSEDATE_SAVE', CLOSEDATE . $apiSaveNode);

// Public routes
define('PUBLIC_FOLDER', 'public/');
define('PAGE_ERROR', 'apperror');
define('APPOINTMENT', 'citas');
define('HOME', 'inicio');
define('PRICES', 'precios');
define('POSTS', 'articulos');
define('CONTACT', 'contacto');
define('LEGAL', 'avisolegal');
define('PRIVACY', 'privacidad');
define('COOKIES', 'cookies');

// Email settings
define('HOST', 'smtp.gmail.com');
define('PORT', '465');
define('USERNAME', 'trablete@gmail.com');
define('USERPASS', '0livares');