'use strict';

// Calendar
var calSource = 'https://www.googleapis.com/calendar/v3/calendars/trablete@gmail.com';
var calApiKey = 'AIzaSyAObCH5JXY008tHNj0KyGk_16w4mFLiW1s';
var apiUrl = calSource + '/events?key=' + calApiKey;
var globalOffset = 2;

// Endpoints
var addEventEndPoint = url + 'home/add';
var loginEndPoint = url + 'login/signin';
var logoutEndPoint = url + 'login/signout';
