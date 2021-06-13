'use strict';

// Calendar
var calId = 'trablete@gmail.com';
var calSource = 'https://www.googleapis.com/calendar/v3/calendars/' + calId;
var calApiKey = 'AIzaSyAObCH5JXY008tHNj0KyGk_16w4mFLiW1s';
var apiUrl = calSource + '/events?key=' + calApiKey;
var globalOffset = 2;

// Endpoints
var addEventEndPoint = url + 'citas/add';
var loginEndPoint = url + 'login/signin';
var logoutEndPoint = url + 'login/signout';
var sendContactMail = url + 'contacto/sendContactMail';