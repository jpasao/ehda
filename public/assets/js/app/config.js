'use strict';

// Calendar
var calId = 'vr.cabrera@gmail.com';
var calSource = 'https://www.googleapis.com/calendar/v3/calendars/' + calId;
var calApiKey = 'AIzaSyCvIO6qUjxT_WVF9vvZo1zePGXU9GvcikA';
var apiUrl = calSource + '/events?key=' + calApiKey;
var globalOffset = 2;

// Endpoints
var addEventEndPoint = url + 'citas/add';
var loginEndPoint = url + 'login/signin';
var logoutEndPoint = url + 'login/signout';
var sendContactMail = url + 'contacto/sendContactMail';