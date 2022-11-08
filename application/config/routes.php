<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
// IPDATA1
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Authentication Routes
$route['login'] = 'login/Login/login_redirect';
$route['signup'] = 'login/Login/signup_redirect';
$route['login/submit'] = 'login/Login/signin';
$route['signup/submit'] = 'login/Login/signup';

// Home Routes
$route['home'] = 'home/Home/index';
$route['quiz/search'] = 'quiz/SearchQuiz/index';

// Challenge Quiz Routes
$route['challenge/(:num)'] = 'quiz/ChallengeQuiz/index/$1';
$route['quiz/challenge/submit'] = 'quiz/SubmitQuizChallenge/index';

// Create Quiz Routes
$route['quiz/new'] = 'quiz/CreateQuiz/index';
$route['quiz/meta/submit'] = 'quiz/CreateQuiz/create_quiz_meta_data';
$route['quiz/question/submit'] = 'quiz/CreateQuiz/create_quiz_question_and_answers';
$route['quiz/submit'] = 'quiz/CreateQuiz/submit_quiz';

